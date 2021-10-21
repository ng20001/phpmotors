<?php
// Vehicles controller (ROOT/vehicles)

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Build a dynamic select dropdown list using the $classifications array
$selectList = '<select name="classificationId" id="classificationId">';
$selectList .= "<option>-Choose Car Classification-</option>";
foreach ($classifications as $classification) {
    $selectList .= "<option value=" . urlencode($classification['classificationId']) . ">" . urlencode($classification['classificationName']) . "</option>";
}
$selectList .= '</select>';

// var_dump: a PHP function that displays variable/array/object info
// var_dump($classifications);
// 	exit;


// Gather input from forms
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    // If no input from forms, gather input from links (E.g. .../?action=something)
    $action = filter_input(INPUT_GET, 'action');
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
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if (empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            $pageTitle = 'Add Car Classification';
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model (sql INSERT execution)
        $regOutcome = addClassification($classificationName);

        // Check and report the result
        if ($regOutcome === 1) {
            $pageTitle = 'Vehicle Management';
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
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $classificationId = filter_input(INPUT_POST, 'classificationId');

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
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

    default:
        $pageTitle = 'Vehicle Management';
        include '../view/vehicle-man.php';
        break;
}
