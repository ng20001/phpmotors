
            <footer>
                <div class="footer-wrap">
                    <hr>
                    <p>&copy; PHP Motors, All rights reserved.</p>
                    <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
                    <p>Last Updated: 30 March, 2018</p>
                </div>
                
            </footer>
        </div>
        <?php
        // echo $_SERVER['REQUEST_URI'];
        if ($_SERVER['REQUEST_URI'] == "/phpmotors/vehicles/"){
            echo "<script src='../js/inventory.js'></script>";
        }
        ?>
    </body>
</html>