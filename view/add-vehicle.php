<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Add Vehicle</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <p>*Note: All fields are required</p>
        <form method="post" action="/phpmotors/vehicles/index.php">
            <?php echo $selectList ?><br><br>

            <label for="invMake">Make</label><br>
            <input name="invMake" id="invMake" type="text"><br><br>
            <label for="invModel">Model</label><br>
            <input name="invModel" id="invModel" type="text"><br><br>

            <label for="invDescription">Description</label><br>
            <textarea name="invDescription" id="invDescription" rows="3" cols="20"></textarea><br><br>

            <label for="invImage">Image Path</label><br>
            <input name="invImage" id="invImage" type="text"><br><br>
            <label for="invThumbnail">Thumbnail Path</label><br>
            <input name="invThumbnail" id="invThumbnail" type="text"><br><br>

            <label for="invPrice">Price</label><br>
            <input name="invPrice" id="invPrice" type="text"><br><br>
            <label for="invStock"># In Stock</label><br>
            <input name="invStock" id="invStock" type="text"><br><br>

            <label for="invColor">Color</label><br>
            <input name="invColor" id="invColor" type="text"><br><br>

            <input type="submit" name="submit" class="account-button" value="Add Vehicle">

            <input type="hidden" name="action" value="add-vehicle">
        </form>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>