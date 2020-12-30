<div class="products-navigation">
    <ul class="products-list">
        <?php
            foreach ($category as $cat): 
                $categoryId = $cat["categoryId"];
                $categoryName = $cat["categoryName"];
        ?>
        <li><a href="products.php?category=<?= $categoryId ?>"><?= $categoryName ?></a></li>

        <?php endforeach; ?>
    </ul>
</div>