<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Add Car Classification</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        
        <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classificationName"></label>
            <input name="classificationName" id="classificationName" type="text"><br>
            <input type="submit" name="submit" class="account-button" value="Add Classification">
            <input type="hidden" name="action" value="add-classification">
        </form>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>