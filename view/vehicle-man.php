<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>
<?php
    if (!$_SESSION['loggedin']) {
        header('Location: ../index.php');
        exit;  
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
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>