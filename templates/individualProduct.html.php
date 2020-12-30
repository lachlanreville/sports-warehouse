<div class="single-product-wrapper">
    <?php foreach ($products as $product):
        $itemId = $product["itemId"];
        $itemName = $product["itemName"];
        $description = $product["description"];

        $price = $product["price"];
        $salePrice = $product["salePrice"];

        $photo = "assets/images/" . $product["photo"];
    ?>
    <div class="featured-wrapper">
        <div class="featured-heading">
            <h2><?= $itemName ?></h2>
        </div>
    </div>
    
    <div class="single-product">
    
        <div class="image-wrapper">
            <img src="<?= $photo ?>" alt="<?= $itemName ?>">
        </div>

        <div class="product-information">
            <span class="product-description">
                <?= $description ?>
            </span>
            <div class="product-price">
            <?php if($salePrice != null && $salePrice > 0.00) {
                echo '<span class="sale-price">$' . $salePrice . '</span>
                <span class="text-was">WAS</span>
                <del class="product-price">$' . $price .'</del>';
            } else {
                echo '<span class="product-no-sale-price">$' . $price . '</span>';
            } ?>
            </div>
            <form method="post">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="1" required>
                <span><?= $message ?></span>
                <input class="cart-add" name="addtocart" type="submit" value="Add to Cart">
            </form>
        </div>
        <?php endforeach ?>
    </div>
</div>