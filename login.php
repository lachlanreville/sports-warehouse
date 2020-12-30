<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Authentication.php";

    session_start();

    $cartNumber = 0;

    $title = "Thanks";
    $orderId = 0;
    $errorMessage = "";

    $productsHeading = "Admin Login";
    ob_start();
    $noProducts = "";
    
    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";

    include "templates/loginForm.html.php";

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        Authentication::login($username, $password);
    }


    $output = ob_get_clean();

    include "templates/layout.html.php";

?>