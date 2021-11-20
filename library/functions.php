<?php

function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    // check to see if the provided clientPassword matches the required pattern
    return preg_match($pattern, $clientPassword);
}

// limit the number of any character within the range of 1-30
function checkClassificationName($classificationName)
{
    $pattern = '/^.{1,30}$/';
    // check to see if the provided classificationName matches the required pattern
    return preg_match($pattern, $classificationName);
}

// make sure the default option (-Choose Car Classification-) is not selected
function checkClassificationId($classificationId)
{
    $pattern = '/^\d{1,}$/';
    return preg_match($pattern, $classificationId);
}

// make sure user input is not a decimal number
function checkInt($num)
{
    $pattern = '/^[^.]+$/';
    return preg_match($pattern, $num);
}

// create nav bar
function buildNavList($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=viewClassification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    // loop through all the vehicles in the provided array
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2><a href='/phpmotors/vehicles/?action=viewVehicle&invId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
        $invPrice = $vehicle['invPrice'];
        $invPrice = number_format($invPrice,2,'.',',');
        $dv .= "<span>&#36;$invPrice</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleInfo($vehicle)
{
    $dv = '<div id="inv-details">';
        $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= "<div id='inv-text'>";
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $invPrice = $vehicle['invPrice'];
        $invPrice = number_format($invPrice,2,'.',',');
        $dv .= "<p>Price: &#36;$invPrice</p>";
        $dv .= "<p>Color: $vehicle[invColor]</p>";
        $dv .= "<p>Stock Available: $vehicle[invStock]</p>";
        $dv .= "<p>$vehicle[invDescription]</p>";
        $dv .= "</div>";
    $dv .= '</div>';
    return $dv;
}