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
        <h2><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h2>
        <p>You are logged in.</p>
        <ul>
            <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
            <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
        </ul>
        <?php 
            if ($_SESSION['clientData']['clientLevel'] == 3){
                echo "<h2>Inventory Management</h2>";
                echo "<p>Use this link to manage the inventory.</p>";
                echo "<span><a href='/phpmotors/vehicles/'>Vehicle Management</a></span>";
            }
        ?>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>