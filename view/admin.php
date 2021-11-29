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
        <h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
        <?php 
        if (isset($_SESSION['message'])){
            echo $_SESSION['message'];
        } else if (isset($message)){
            echo $message;
        }
         ?>
        <p>You are logged in.</p>
        <ul>
            <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
            <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
        </ul>
        <h2>Account Management</h2>
        <p>Use this link to update account information.</p>
        <span><a href="/phpmotors/accounts/?action=update">Update Account Information</a></span>
        <?php 
            if ($_SESSION['clientData']['clientLevel'] == 3){
                echo "<h2>Inventory Management</h2>";
                echo "<p>Use this link to manage the inventory.</p>";
                echo "<span><a href='/phpmotors/vehicles/'>Vehicle Management</a></span>";
                echo "<h2>Image Management</h2>";
                echo "<p>Use this link to manage the images.</p>";
                echo "<span><a href='/phpmotors/uploads/'>Image Management</a></span>";
            }
        ?>
        <?php unset($_SESSION['message']); ?>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>