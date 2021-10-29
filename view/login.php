<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Sign in</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="clientEmail">Email</label><br>
            <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required placeholder="Enter a valid email address"><br><br>
            <label for="clientPassword">Password (Passwords must be at least 8 characters and contain at least 1 number, 1 captital letter and 1 special character)</label><br>
            <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="submit" class="account-button" value="Sign-in"><br><br>

            <input type="hidden" name="action" value="Login">
            <a href="/phpmotors/accounts/?action=registration">Not a member yet?</a>
        </form>

    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>