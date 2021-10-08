<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Registration</h1>

        <form>
            <label for="clientFirstname">First Name</label><br>
            <input name="clientFirstname" id="clientFirstname" type="text"><br>
            <label for="clientLastname">Last Name</label><br>
            <input name="clientLastname" id="clientLastname" type="text"><br>
            <label for="clientEmail">Email</label><br>
            <input name="clientEmail" id="clientEmail" type="email"><br><br>
            <label for="clientPassword">Password (Passwords must be at least 8 characters and contain at least 1 number, 1 captital letter and 1 special character)</label><br>
            <input name="clientPassword" id="clientPassword" type="password"><br>
            <input type="submit" class="account-button" value="Register">
        </form>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>