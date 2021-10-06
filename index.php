<?php
// MAIN CONTROLLER: The very first file a user request lands on

// Gather input from forms
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    // If no input from forms, gather input from links (E.g. .../?action=something)
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'something':

        break;

    default:
        include 'view/home.php';
}
