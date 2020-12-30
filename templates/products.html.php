<div class="featured-wrapper">
    <div class="featured-heading">
        <h2><?= $productsHeading ?></h2>
    </div>
    <div class="featured-products">

    <span><?= $noProducts ?></span>

    <?php foreach ($products as $item): 
        $itemId = $item["itemId"];
        $itemName = $item["itemName"];

        $price = $item["price"];
        $salePrice = $item["salePrice"];

        $photo = "assets/images/" . $item["photo"];
    ?>
        <a href="viewProduct.php?product=<?= $itemId ?>" class="product-wrapper">
            <div class="product-image-wrapper">
                <img class="product-image" alt="<?= $itemName ?>" src="<?= $photo ?>">
            </div>
            <p>

            <?php if($salePrice != null && $salePrice > 0.00) {
                echo '<span class="sale-price">$' . $salePrice . '</span>
                <span class="text-was">WAS</span>
                <del class="product-price">$' . $price .'</del>';
            } else {
                echo '<span class="product-no-sale-price">$' . $price . '</span>';
            } ?>
            </p>

            <p class="product-description">
                <?= $itemName ?>
            </p>
        </a>
        <?php endforeach ?>
    </div>
</div>