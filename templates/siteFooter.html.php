<div class="footer-wrapper">
    <div class="footer-container">
        <div class="footer-nav">
            <div class="footer-site">
                <span class="footer-title">Site Navigation</span>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About SW</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">View Products</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-products">
                <span class="footer-title">Products Categories</span>
                <ul>
                    <?php
                        foreach ($category as $cat): 
                            $categoryId = $cat["categoryId"];
                            $categoryName = $cat["categoryName"];
                    ?>
                    <li><a href="index.php?category=<?= $categoryId ?>"><?= $categoryName ?></a></li>

                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="footer-contact">
                <span class="footer-title">Contact Sports Warehouse</span>
                <div class="contact-list">
                    <div class="contact-container">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </div>
                    <div class="contact-container">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>

                    </div>
                    <div class="contact-container">
                        <i class="fas fa-paper-plane"></i>
                        <span>Other</span>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <footer class="site-footer">
        <span>&copy; Copyright 2020 Sports Warehouse. All rights reserved. Website made by Awesomesauce
            Design.</span>
    </footer>
</div>