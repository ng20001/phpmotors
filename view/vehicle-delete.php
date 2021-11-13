<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>
<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] != 3) {
    header('Location: ../index.php');
    exit;
}
?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>
            <?php
            if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Delete $invMake $invModel";
            }
            ?>
        </h1>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        <form method="post" action="/phpmotors/vehicles/">
            <fieldset>
                <label for="invMake">Vehicle Make</label>
                <input type="text" readonly name="invMake" id="invMake" <?php
                                                                        if (isset($invInfo['invMake'])) {
                                                                            echo "value='$invInfo[invMake]'";
                                                                        } ?>>
                <br><br>
                <label for="invModel">Vehicle Model</label>
                <input type="text" readonly name="invModel" id="invModel" <?php
                                                                            if (isset($invInfo['invModel'])) {
                                                                                echo "value='$invInfo[invModel]'";
                                                                            } ?>>
                <br><br>
                <label for="invDescription">Vehicle Description</label>
                <textarea name="invDescription" readonly id="invDescription"><?php
                                                                                if (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                }
                                                                                ?></textarea>
                <br><br>
                <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } ?>">

            </fieldset>
        </form>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>