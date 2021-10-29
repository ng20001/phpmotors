<?php
// Accounts controller (ROOT/accounts)

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
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

switch ($action) {
    case 'login':
        $pageTitle = 'Account Login';
        include '../view/login.php';
        break;

    case 'registration':
        $pageTitle = 'Account Registration';
        include '../view/registration.php';
        break;

    case 'Login':
        $pageTitle = 'Login';

        // Filter, sanitize and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        // Check clientEmail if it "looks" like a valid email address
        $clientEmail = checkEmail($clientEmail);

        // Check clientPassword if it matches the given pattern. checkPassword() returns either 1 or 0
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            $pageTitle = 'Account Login';
            include '../view/login.php';
            exit;
        }

        break;
        

    case 'register':
        // echo 'You are in the register case statement.';

        // Filter, sanitize and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        // Check clientEmail if it "looks" like a valid email address
        $clientEmail = checkEmail($clientEmail);

        // Check clientPassword if it matches the given pattern. checkPassword() returns either 1 or 0
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            $pageTitle = 'Account Registration';
            include '../view/registration.php';
            exit;
        }

        // Hash the password before it's sent to the model
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model (sql INSERT execution)
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $pageTitle = 'Account Login';
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            $pageTitle = 'Account Registration';
            include '../view/registration.php';
            exit;
        }

        break;

    default:
        $pageTitle = 'Home';
        header('Location: ../index.php');
        break;
}
