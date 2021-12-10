<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1><?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?></h1>
        <?php if (isset($message)) {
            echo $message;
        }
        ?>
        <?php if (isset($vehicleDetails)) {
            echo $vehicleDetails;
        } ?>

        <?php if (isset($thumbnailsDisplay)) {
            echo $thumbnailsDisplay;
        } ?>
        <hr>
        <h2>Customer Reviews</h2>
        <?php
        if (isset($_SESSION['loggedin'])) {
            $clientData = $_SESSION['clientData'];
            echo '<h2>Review the ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . '</h2>';
            if (isset($_SESSION['reviewConfirmation'])){
                echo $_SESSION['reviewConfirmation'];
            }
            echo "<form method='post' action='/phpmotors/reviews/'>";
            echo "<label for='clientScreenName'>Screen Name: </label><br>";
            echo "<input name='clientScreenName' id='clientScreenName' type='text' value='" . substr($clientData['clientFirstname'], 0, 1) . "$clientData[clientLastname]' readonly><br><br>";
            echo "<label for='reviewText'>Review: </label><br>";
            echo "<textarea name='reviewText' id='reviewText' class='reviewText' rows='5' cols='40' required></textarea><br><br>";
            echo '<input type="submit" name="submit" class="" value="Submit Review"><br><br>';
            echo '<input type="hidden" name="action" value="submit">';
            echo "<input type='hidden' name='invId' value='$invId'>";
            echo "<input type='hidden' name='clientId' value='$clientData[clientId]'>";
            echo '</form>';
        } else {
            echo "You must <a href='/phpmotors/accounts/?action=login'>login</a> to write a review. <br><br>";
        } 
        if (isset($reviewsDisplay)){
            echo $reviewsDisplay;
        } else {
            echo $reviewMessage;
        }
        ?>

    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>
<?php if (isset(($_SESSION['reviewConfirmation']))) {
    unset($_SESSION['reviewConfirmation']);
} ?>
