<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>
<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] != 3) {
    header('Location: ../index.php');
    exit;
}
?>
<?php
// Build the classifications option list
$selectList = '<select name="classificationId" id="classificationId">';
$selectList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
    $selectList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $selectList .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] === $invInfo['classificationId']) {
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
        <h1>
            <?php
            if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
            }
            ?>
        </h1>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <p>*Note: All fields are required</p>
        <form method="post" action="/phpmotors/vehicles/index.php">
            <?php echo $selectList ?><br><br>

            <label for="invMake">Make</label><br>
            <input name="invMake" id="invMake" type="text" <?php if (isset($invMake)) {
                                                                echo "value='$invMake'";
                                                            } elseif (isset($invInfo['invMake'])) {
                                                                echo "value='$invInfo[invMake]'";
                                                            } ?>required><br><br>
            <label for="invModel">Model</label><br>
            <input name="invModel" id="invModel" type="text" <?php if (isset($invModel)) {
                                                                    echo "value='$invModel'";
                                                                } elseif (isset($invInfo['invModel'])) {
                                                                    echo "value='$invInfo[invModel]'";
                                                                } ?>required><br><br>

            <label for="invDescription">Description</label><br>
            <textarea name="invDescription" id="invDescription" rows="3" cols="20" required><?php if (isset($invDescription)) {
                                                                                                echo "$invDescription";
                                                                                            } elseif (isset($invInfo['invDescription'])) {
                                                                                                echo "$invInfo[invDescription]'";
                                                                                            } ?></textarea><br><br>

            <label for="invImage">Image Path</label><br>
            <input name="invImage" id="invImage" type="text" <?php if (isset($invImage)) {
                                                                    echo "value='$invImage'";
                                                                } elseif (isset($invInfo['invImage'])) {
                                                                    echo "value='$invInfo[invImage]'";
                                                                } ?>required><br><br>
            <label for="invThumbnail">Thumbnail Path</label><br>
            <input name="invThumbnail" id="invThumbnail" type="text" <?php if (isset($invThumbnail)) {
                                                                            echo "value='$invThumbnail'";
                                                                        } elseif (isset($invInfo['invThumbnail'])) {
                                                                            echo "value='$invInfo[invThumbnail]'";
                                                                        } ?>required><br><br>

            <label for="invPrice">Price</label><br>
            <input name="invPrice" id="invPrice" type="number" placeholder="0.00" step="0.01" min="0" <?php if (isset($invPrice)) {
                                                                                                            echo "value='$invPrice'";
                                                                                                        } elseif (isset($invInfo['invPrice'])) {
                                                                                                            echo "value='$invInfo[invPrice]'";
                                                                                                        } ?>required><br><br>
            <label for="invStock"># In Stock</label><br>
            <input name="invStock" id="invStock" type="number" placeholder="0" min="0" <?php if (isset($invStock)) {
                                                                                            echo "value='$invStock'";
                                                                                        } elseif (isset($invInfo['invStock'])) {
                                                                                            echo "value='$invInfo[invStock]'";
                                                                                        } ?>required><br><br>

            <label for="invColor">Color</label><br>
            <input name="invColor" id="invColor" type="text" <?php if (isset($invColor)) {
                                                                    echo "value='$invColor'";
                                                                } elseif (isset($invInfo['invColor'])) {
                                                                    echo "value='$invInfo[invColor]'";
                                                                } ?>required><br><br>

            <input type="submit" name="submit" class="account-button" value="Update Vehicle">

            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="
            <?php if (isset($invInfo['invId'])) {
                echo $invInfo['invId'];
            } elseif (isset($invId)) {
                echo $invId;
            } ?>
            ">
        </form>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>