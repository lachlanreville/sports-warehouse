<header class="site-heading">
    <div class="business-logo">
        <h1>
            <img src="assets/images/logo.png" alt="sports warehouse logo">
        </h1>
    </div>
</header>

<p>Please fill out this form.</p>

<form action="contact.php"  method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Contact Me</legend>
        <p>
            <label for="firstName">First Name: *</label>
            <input type="text" name="firstName" id="firstName" required>
        </p>
        <p>
            <label for="lastName">Last Name: *</label>
            <input type="text" name="lastName" id="lastName" required> 
        </p>
        <p>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" name="phoneNumber" id="phoneNumber">
        </p>
        <p>
            <label for="emailAddress">Email Address: *</label>
            <input type="email" name="emailAddress" id="emailAddress" required>
        </p>
        <p>
            <label for="question">Question:</label>
            <input type="text" name="question" id="question">
        </p>
        <p>
            <input type="submit" name="submit" value="Contact Me">
        </p>
    </fieldset>
    <p><?= $message ?></p>
</form>