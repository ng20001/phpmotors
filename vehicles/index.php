<?php
// Vehicles controller (ROOT/vehicles)

// Create or access a Session
// If there is no session, one is created. Otherwise, the existing session is used.
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar by calling buildNavList function from functions.php
$navList = buildNavList($classifications);

// Gather input from forms
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    // If no input from forms, gather input from links (E.g. .../?action=something)
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the 'firstname' cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'classification':
        $pageTitle = 'Add Car Classification';
        include '../view/add-classification.php';
        break;

    case 'vehicle':
        $pageTitle = 'Add Vehicle';
        include '../view/add-vehicle.php';
        break;

    case 'add-classification':
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // check classificationName if it matches the given pattern 
        $checkClassificationName = checkClassificationName($classificationName);

        // Check for missing data
        if (empty($checkClassificationName)) {
            $message = '<p>Please provide correct information for all empty form fields.</p>';
            $pageTitle = 'Add Car Classification';
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model (sql INSERT execution)
        $regOutcome = addClassification($classificationName);

        // Check and report the result
        if ($regOutcome === 1) {
            // $pageTitle = 'Vehicle Management';
            header('Location: index.php');
            exit;
        } else {
            $message = "<p>Process failed. Please try again.</p>";
            include 'index.php';
            exit;
        }

        break;

    case 'add-vehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)); //2nd filter: float sanitize
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        // Input type check
        $checkClassificationId = checkClassificationId($classificationId);
        $checkInvStock = checkInt($invStock);

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($checkInvStock) || empty($invColor) || empty($checkClassificationId)) {
            $message = '<p>Please provide correct information for all form fields.</p>';
            $pageTitle = 'Add Vehicle';
            include '../view/add-vehicle.php';
            exit;
        }

        // Send the data to the model (sql INSERT execution)
        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p>The vehicle has been added to the inventory.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Process failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        break;


    case 'getInventoryItems':
        // This case does not display any view to the frontend user
        // from inventory.js 
        // to inventory.js

        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // ***Fetch the vehicles by classificationId from the Database***
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back to inventory.js
        echo json_encode($inventoryArray);
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT); // INPUT_GET: name-value from url injected to the vehicle management view by inventory.js
        $invInfo = getInvItemInfo($invId); // get that one vehicle user selected by its id
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId); // DB DELETE
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

    case 'updateVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)); //2nd filter: float sanitize
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Input type check
        $checkClassificationId = checkClassificationId($classificationId);
        $checkInvStock = checkInt($invStock);

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($checkInvStock) || empty($invColor) || empty($checkClassificationId)) {
            $message = '<p>Please provide correct information for all form fields.</p>';
            $pageTitle = 'Update Vehicle';
            include '../view/vehicle-update.php';
            exit;
        }

        // Send the data to the model (sql INSERT execution)
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // Check and report the result
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Process failed. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

    default:
        $pageTitle = 'Vehicle Management';

        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
        break;
}
