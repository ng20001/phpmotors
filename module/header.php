<!DOCTYPE html>
<html lang="en-US">

<head>

    <title>
        <?php
        if (isset($_SESSION['pageTitle'])) {
            echo $_SESSION['pageTitle'] . ' | PHP Motors';
        } else if (isset($pageTitle)) {
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