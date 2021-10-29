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

function checkClassificationName($classificationName)
{
    $pattern = '/^.{1,30}$/';
    // check to see if the provided classificationName matches the required pattern
    return preg_match($pattern, $classificationName);
}

function checkClassificationId($classificationId)
{
    $pattern = '/^\d{1,}$/';
    return preg_match($pattern, $classificationId);
}

function checkInt($num)
{
    $pattern = '/^[^.]+$/';
    return preg_match($pattern, $num);
}

function buildNavList($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}