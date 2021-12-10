<?php
// Reviews controller (ROOT/reviews)

// Create or access a Session
// If there is no session, one is created. Otherwise, the existing session is used.
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'submit': //submit review
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($reviewText) || empty($invId) || empty($clientId)) {
            $_SESSION['reviewConfirmation'] = '<p>Please provide information for the empty field.</p>';
            header('location: /phpmotors/vehicles/?action=viewVehicle&invId=' . $invId);
            exit;
        }

        $rowsChanged = addReview($reviewText, $invId, $clientId);

        if ($rowsChanged === 1) {
            $_SESSION['reviewConfirmation'] = "<p>Thanks for reviewing, your review is displayed below.</p>";
            header('location: /phpmotors/vehicles/?action=viewVehicle&invId=' . $invId);
            exit;
        } else {
            $_SESSION['reviewConfirmation'] = "<p>Reviewing failed. Please try again.</p>";
            header('location: /phpmotors/vehicles/?action=viewVehicle&invId=' . $invId);
            exit;
        }
        break;

    case 'editView': //deliver edit view
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_STRING);
        $review = getReview($reviewId);

        $pageTitle = "Edit review";
        include '../view/review-update.php';
        break;

    case 'edit': //update the review
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_STRING);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        if (empty($reviewText) || empty($reviewId)) {
            $_SESSION['message'] = '<p>Please provide information for the empty field.</p>';
            include '../view/review-update.php';
            exit;
        }

        $rowsChanged = updateReview($reviewId, $reviewText);

        if ($rowsChanged === 1) {
            $_SESSION['message'] = "<p>The review was updated successfully.</p>";
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Review update failed. Please try again.</p>";
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        }
        break;

    case 'delView': //deliver delete view
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_STRING);
        $review = getReview($reviewId);

        $pageTitle = "Delete review";
        include '../view/review-delete.php';
        break;

    case 'delete': //delete the review
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_STRING);
        // $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        // if (empty($reviewText) || empty($reviewId)) {
        //     $_SESSION['message'] = '<p>Please provide information for the empty field.</p>';
        //     include '../view/review-update.php';
        //     exit;
        // }

        $rowsChanged = deleteReview($reviewId);

        if ($rowsChanged === 1) {
            $_SESSION['message'] = "<p>The review has been deleted.</p>";
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Review deletion failed. Please try again.</p>";
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        }
        break;

    default:
        if (isset($_SESSION['loggedin'])) {
            include '../view/admin.php';
        } else {
            header('location: /phpmotors/');
        }
        break;
}
