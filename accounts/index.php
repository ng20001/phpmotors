<?php
// Accounts controller (ROOT/accounts)

// Create or access a Session
// If there is no session, one is created. Otherwise, the existing session is used.
session_start();

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

// Check if the 'firstname' cookie exists, get its value
// if (isset($_COOKIE['firstname'])) {
//     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
// }

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

        // Filter, sanitize and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        // Check clientEmail if it "looks" like a valid email address
        $clientEmail = checkEmail($clientEmail);
        // Check clientPassword if it matches the given pattern. checkPassword() returns either 1 or 0
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $pageTitle = 'Account Login';
            $message = '<p>Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);

        if (!$clientData) {
            $pageTitle = 'Account Login';
            $message = '<p>Incorrect password or email address. Try again.</p>';
            include '../view/login.php';
            exit;
        }

        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        // var_dump($clientPassword);
        // var_dump($clientData['clientPassword']);
        // var_dump($hashCheck);
        // exit;

        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $pageTitle = 'Account Login';
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);

        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        // Send them to the admin view
        $pageTitle = 'Account Information';
        include '../view/admin.php';
        exit;

        break;

    case 'Logout':
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        break;

    case 'admin':
        $pageTitle = 'Account Information';
        include '../view/admin.php';
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

        // Chcek if clientEmail exists in the database
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p>That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

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
            // Set cookie after successful registration
            // @param: cookie name(required), value of cookie name, expiry, path of cookie visibility
            // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $pageTitle = 'Account Login';
            include '../view/login.php';
            // header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            $pageTitle = 'Account Registration';
            include '../view/registration.php';
            exit;
        }

    case 'update':
        $pageTitle = "Account Update";
        $clientInfo = $_SESSION['clientData'];
        include '../view/client-update.php';
        break;

    case 'updateInfo':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check clientEmail if it "looks" like a valid email address
        $clientEmail = checkEmail($clientEmail);

        // Chcek if clientEmail exists in the database
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            // Set condition for client who wants to change their first name or last name with the same email address
            if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
                $message = '<p>That email address already exists. Please enter another email address.</p>';
                $pageTitle = 'Account Update';
                include '../view/client-update.php';
                exit;
            }
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p>Please provide valid information for all empty form fields.</p>';
            $pageTitle = 'Account Update';
            include '../view/client-update.php';
            exit;
        }

        $updateResult = updateInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Store the updated array into the session
        $_SESSION['clientData'] = getClient($clientEmail);

        if ($updateResult) {
            $_SESSION['message'] = "<p>You have successfully updated your account information.</p>";
            $pageTitle = 'Account Information';
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Update process failed, or no changes have been made. Please try again.</p>";
            $pageTitle = 'Account Update';
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        }

        break;

    case 'updatePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check clientPassword if it matches the given pattern. checkPassword() returns either 1 or 0
        $checkPassword = checkPassword($clientPassword);
        if (empty($checkPassword)) {
            $message = '<p>Please provide valid information for the empty form field.</p>';
            $pageTitle = 'Account Update';
            include '../view/client-update.php';
            exit;
        }

        // Hash the password before it's sent to the model
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // update the password 
        $updateResult = updatePassword($hashedPassword, $clientId);

        if ($updateResult) {
            $_SESSION['message'] = "<p>You have successfully updated your account password.</p>";
            $pageTitle = 'Account Information';
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Update process failed. Please try again.</p>";
            $pageTitle = 'Account Information';
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        }
        break;

    default:
        header('Location: ../index.php');
        break;
}
