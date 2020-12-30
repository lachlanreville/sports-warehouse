<div class="cart-wrapper">
    <table>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

    <?php foreach($cartItems as $product):

        $productName = $product->getItemName();
        $price = sprintf('%01.2f', $product->getPrice());
        $productId = $product->getItemId();
        $quantity = $product->getQuantity();
    ?>
        <tr>
            <td><?= $productName ?></td>
            <td><?= $price ?></td>
            <td><?= $quantity ?></td>
            <td>
                <form method="post">
                    <input type="submit" name="remove" value="Remove">
                    <input type="hidden" value="<?= $productId ?>" name="productId">
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>Total: <?= sprintf('%01.2f', $totalPrice) ?></td>
        <td></td>
        <td></td>
        <td><a href="checkout.php">Checkout</a></td>
    </tr>
    </table>
</div>