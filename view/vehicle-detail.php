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
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>