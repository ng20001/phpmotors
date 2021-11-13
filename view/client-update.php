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
        <h1>Manage Account</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <h2>Update Account</h2>
        <form method="post" action="/phpmotors/accounts/">
            <label for="clientFirstname">First Name</label><br>
            <input name="clientFirstname" id="clientFirstname" type="text" <?php if (isset($clientFirstname)) {
                                                                                echo "value='$clientFirstname'";
                                                                            } elseif (isset($clientInfo['clientFirstname'])) {
                                                                                echo "value='$clientInfo[clientFirstname]'";
                                                                            }  ?> required><br><br>
            <label for="clientLastname">Last Name</label><br>
            <input name="clientLastname" id="clientLastname" type="text" <?php if (isset($clientLastname)) {
                                                                                echo "value='$clientLastname'";
                                                                            } elseif (isset($clientInfo['clientLastname'])) {
                                                                                echo "value='$clientInfo[clientLastname]'";
                                                                            }  ?> required><br><br>
            <label for="clientEmail">Email</label><br>
            <input name="clientEmail" id="clientEmail" type="email" <?php if (isset($clientEmail)) {
                                                                        echo "value='$clientEmail'";
                                                                    } elseif (isset($clientInfo['clientEmail'])) {
                                                                        echo "value='$clientInfo[clientEmail]'";
                                                                    }  ?> required placeholder="Enter a valid email address"><br><br>

            <input type="submit" name="submit" class="account-button" value="Update Info">
            <input type="hidden" name="action" value="updateInfo">
            <input type="hidden" name="clientId" value="
            <?php if (isset($clientInfo['clientId'])) {
                echo $clientInfo['clientId'];
            } elseif (isset($clientId)) {
                echo $clientId;
            } ?>
            ">
        </form>
        <br>
        <h2>Update Password</h2>
        <form method="post" action="/phpmotors/accounts/">
            <label for="clientPassword">Password must be at least 8 characters and contain at least 1 number, 1 captital letter and 1 special character<br><br>*note your original password will be changed.<br><br>Password</label><br>
            <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="submit" name="submit" class="account-button" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="
            <?php if (isset($clientInfo['clientId'])) {
                echo $clientInfo['clientId'];
            } elseif (isset($clientId)) {
                echo $clientId;
            } ?>
            ">
        </form>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>