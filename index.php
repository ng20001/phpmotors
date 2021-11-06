<?php
// MAIN CONTROLLER (ROOT)
// The very first file a client lands on

// Create or access a Session
// If there is no session, one is created. Otherwise, the existing session is used.
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

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
    default:
        $pageTitle = 'Home';
        include 'view/home.php';
}
