<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Sign in</h1>

        <form>
            <label for="clientEmail">Email</label><br>
            <input name="clientEmail" id="clientEmail" type="text"><br><br>
            <label for="clientPassword">Password (Passwords must be at least 8 characters and contain at least 1 number, 1 captital letter and 1 special character)</label><br>
            <input name="clientPassword" id="clientPassword" type="password"><br>
            <input type="submit" class="account-button" value="Sign-in"><br><br>
            <a href="/phpmotors/accounts/?action=register">Not a member yet?</a>
        </form>

    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>