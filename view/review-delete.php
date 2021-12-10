<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>

    <div class="main-wrap">
        <h1>Delete <?php echo $review['invMake'] . ' ' . $review['invModel'] ?> review</h1>
        <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        } ?>
        <div class='reviewWrap'>
            <p>Reviewed on <?php echo $review['reviewDate'] ?></p>
            <p class="delete-message">Deletes cannot be undone. Are you sure you want to delete this review?</p>
            <form method="post" action="/phpmotors/reviews/">
                <label for='reviewText'>Review Text</label><br>
                <textarea name='reviewText' id='reviewText' class='reviewText' rows='7' cols='40' readonly><?php echo $review['reviewText'] ?></textarea><br>
                <input type="submit" name="submit" class="account-button" value="Delete">
                <input type="hidden" name="action" value="delete">
                <input type='hidden' name='reviewId' value='<?php echo $reviewId ?>'>
            </form>
        </div>
    </div>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/module/footer.php'; ?>