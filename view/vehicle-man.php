<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>
<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] != 3) {
    header('Location: ../index.php');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-wrap">
        <h1>Vehicle Management</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <ul>
            <li><a href="/phpmotors/vehicles/?action=classification">Add Classification</a></li>
            <li><a href="/phpmotors/vehicles/?action=vehicle">Add Vehicle</a></li>
        </ul>

        <?php
        // if (isset($message)) {
        //     echo $message;
        // }
        if (isset($classificationList)) {
            echo '<h2>Vehicles By Classification</h2>';
            echo '<p>Choose a classification to see those vehicles</p>';
            echo $classificationList;
        }
        ?>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>
<?php unset($_SESSION['message']); ?>