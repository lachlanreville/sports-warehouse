<form method="post" action="thanks.php" id="checkout">
    <fieldset>
        <legend>Delivery Details</legend>
        <p>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName">
            <span id="firstNameError"></span>
        </p>
        <p>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName">
            <span id="lastNameError"></span>
        </p>
        <p>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <span id="addressError"></span>
        </p>
        <p>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
            <span id="phoneError"></span>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <span id="emailError"></span>
        </p>
    </fieldset>
    <fieldset>
        <legend>Payment</legend>
        <p>
            <label for="creditcard">Credit card number:</label>
            <input type="text" id="creditcard" name="creditcard">
            <span id="creditCardError"></span>
        </p>
        <p>
            <label for="nameOnCard">Name on card:</label>
            <input type="text" id="nameOnCard" name="nameOnCard">
            <span id="nameOnCardError"></span>
        </p>
        <p>
            <label for="expiry">Expiry date:</label>
            <input type="text" id="expiry" name="expiry">
            <span id="expiryError"></span>
        </p>
        <p>
            <label for="csv">CSV:</label>
            <input type="text" id="csv" name="csv">
            <span id="csvError"></span>
        </p>
        <p><input type="submit" name="pay" value="Pay"></p>
    </fieldset>
</form>

<script src="assets/js/checkoutValidation.js"></script>