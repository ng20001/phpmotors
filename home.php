<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="screen" href="css/style.css">
</head>

<body>
    <div class="wrap">
        <header>
            <img src="/phpmotors/images/site/logo.png" alt="PHPMotors logo">
        </header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Classic</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">SUV</a></li>
                <li><a href="#">Trucks</a></li>
                <li><a href="#">Used</a></li>
            </ul>
        </nav>
        <main>
            <div class="own-today">
                <h1>Welcome to PHP Motors!</h1>
                <img id="car" src="../phpmotors/images/delorean.jpg" alt="car">
                <div class="own-today-msg">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                    <br>
                </div>
                <div id="own-today-button"><a href="#"><img src="../phpmotors/images/site/own_today.png" alt="own today button"></a></div>
            </div>

            <div class="reviews">
                <h1>DMC Delorean Reviews</h1>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>

            <div class="upgrades">
                <h1>Delorean Upgrades</h1>
                <div class="upgrades-grid">
                    <figure>
                        <img src="../phpmotors/images/upgrades/flux-cap.png" alt="flux cap image">
                        <figcaption><a href="#">Flux Capacitor</a></figcaption>
                    </figure>
                    <figure>
                        <img src="../phpmotors/images/upgrades/flame.jpg" alt="flame image">
                        <figcaption><a href="#">Flame Decals</a></figcaption>
                    </figure>
                    <figure>
                        <img src="../phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper image">
                        <figcaption><a href="#">Bumper Stickers</a></figcaption>
                    </figure>
                    <figure>
                        <img src="../phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap image">
                        <figcaption><a href="#">Hub Caps</a></figcaption>
                    </figure>

                </div>
            </div>

        </main>
        <footer>
            <div class="footer-wrap">
                <hr>
                <p>&copy; PHP Motors, All rights reserved.</p>
                <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
                <p>Last Updated: 30 March, 2018</p>
            </div>

        </footer>
    </div>
</body>

</html>