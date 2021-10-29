<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>
<?php 
    // Build a dynamic select dropdown list using the $classifications array
    $selectList = '<select name="classificationId" id="classificationId" required>';
    $selectList .= '<option value="">-Choose Car Classification-</option>';
    foreach ($classifications as $classification) {
        $selectList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
                $selectList .= ' selected ';
            }
        }
        $selectList .= ">$classification[classificationName]</option>";
    }
    $selectList .= '</select>';
?>
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
            <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";}  ?>required><br><br>
            <label for="invModel">Model</label><br>
            <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";}  ?>required><br><br>

            <label for="invDescription">Description</label><br>
            <textarea name="invDescription" id="invDescription" rows="3" cols="20" required><?php if(isset($invDescription)){echo "$invDescription";}?></textarea><br><br>

            <label for="invImage">Image Path</label><br>
            <input name="invImage" id="invImage" type="text" <?php if(isset($invImage)){echo "value='$invImage'";}  ?>required><br><br>
            <label for="invThumbnail">Thumbnail Path</label><br>
            <input name="invThumbnail" id="invThumbnail" type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>required><br><br>

            <label for="invPrice">Price</label><br>
            <input name="invPrice" id="invPrice" type="number" placeholder="0.00" step="0.01" min="0" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>required><br><br>
            <label for="invStock"># In Stock</label><br>
            <input name="invStock" id="invStock" type="number" placeholder="0" min="0" <?php if(isset($invStock)){echo "value='$invStock'";}  ?>required><br><br>

            <label for="invColor">Color</label><br>
            <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";}  ?>required><br><br>

            <input type="submit" name="submit" class="account-button" value="Add Vehicle">

            <input type="hidden" name="action" value="add-vehicle">
        </form>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>