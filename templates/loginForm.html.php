<div class="featured-wrapper">
    <div class="featured-heading">
        <h2><?= $productsHeading ?></h2>
    </div>

    <div>
        <span><?= $errorMessage ?></span>
        <form method="post">
            <p>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </p>
            <input type="submit" value="Login" name="login" id="login">
        </form>
    </div>

</div>