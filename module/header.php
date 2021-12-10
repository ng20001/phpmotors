<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        <?php

        if (isset($_SESSION['pageTitle'])) {
            $pageTitle = $_SESSION['pageTitle'];
        }
        if (preg_match('/mod/', $_SERVER['REQUEST_URI'])) {
            if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                $pageTitle = "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                $pageTitle = "Modify $invMake $invModel";
            }
        } else if (preg_match('/delete/', $_SERVER['REQUEST_URI'])) {
            if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                $pageTitle = "Delete $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                $pageTitle = "Delete $invMake $invModel";
            }
        }

        if (isset($pageTitle)) {
            echo $pageTitle . ' | PHP Motors';
        }
        ?>
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/style.css">
</head>

<body>
    <div class="header-wrap">
        <header>
            <a href="/phpmotors/"><img src="/phpmotors/images/site/logo.png" alt="PHPMotors logo"></a>
            <?php
            if (isset($_SESSION['loggedin'])) {
                echo "<span id='account-url'>Welcome, <a href='/phpmotors/accounts/?action=admin'>" . $_SESSION['clientData']['clientFirstname'] . "</a> | <a href='/phpmotors/accounts/?action=Logout'>Logout</a></span>";
            } else {
                echo "<span id='account-url'><a href='/phpmotors/accounts/?action=login'>My Account</a></span>";
            } ?>
        </header>