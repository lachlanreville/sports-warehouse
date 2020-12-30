<div class="featured-wrapper">
    <div class="featured-heading">
        <h2><?= $productsHeading ?></h2>
    </div>

<?php if($orderId > 0): ?>
    <p>Thank you, your order number is <?= $orderId ?></p>
<?php else: ?>
    <p>Something went wrong and the order was not placed</p>
<?php endif; ?>
<p><a href="index.php">Back to the start</a></p>
</div>