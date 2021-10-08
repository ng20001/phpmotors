<?php

// Connection function to phpmotors database
function phpmotorsConnect()
{
    $server = 'localhost:3307';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = '123';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        // echo 'Connection successful! ';
        return $link;
    } catch (PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}

// phpmotorsConnect();