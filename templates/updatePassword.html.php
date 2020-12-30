<div class="featured-wrapper">
    <div class="featured-heading">
        <h2>Updating Account Password</h2>
    </div>

    <div>
        <span><?= $errorMessage ?></span>
        <form method="post">
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </p>
            <input type="submit" value="Update" name="login" id="login">
        </form>
    </div>

</div>