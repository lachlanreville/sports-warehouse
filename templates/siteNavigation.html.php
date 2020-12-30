<div class="top-nav">
    <nav class="navigation-wrapper">
        <div class="nav-left">
            <ul class="site-navigation mobile-visible mobile-site-toggle">
                <li>
                    <button class="toggle-nav" id="mobile-nav-toggle">
                        <i class="fas fa-bars"></i>
                        Menu
                    </button>
                </li>
            </ul>
            <ul id="mobile-nav" class="mobile-nav hidden">
                <li class="list-type-none">
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                    <a href="products.php">Product</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
            </ul>
            <ul class="site-navigation mobile-hidden">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About SW</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="products.php">View Products</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="site-navigation">
                <li id="login-mobile-hidden" class="mobile-hidden">
                    <i class="nav-icons fas fa-lock"></i>
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <i class="nav-icons fas fa-shopping-cart"></i>
                    <a href="cart.php">View Cart</a>
                </li>
                <li>
                    <span class="cart-items"><?= $cartNumber ?> Items</span>
                </li>
            </ul>
        </div>
    </nav>
</div>