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
    include "templates/adminCustomization.html.php";

    include "templates/updatePassword.html.php";

    Authentication::protect();

    if(isset($_POST["login"])) {
        $username = $_SESSION["username"];
        $password = $_POST["password"];

        Authentication::updateUser($username, $password);
        Authentication::logout();
    }


    $output = ob_get_clean();

    include "templates/layout.html.php";

?>