<?php
    require_once "classes/ShoppingCart.php";

    session_start();

    $cartNumber = 0;

 
    $title = "Thanks";
    $orderId = 0;

    if(isset($_POST["pay"]) && isset($_SESSION["cart"]))
    {
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $creditcard = $_POST["creditcard"];
        $csv = $_POST["csv"];
        $email = $_POST["email"];
        $expiry = $_POST["expiry"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $nameOnCard = $_POST["nameOnCard"];

        $cart = $_SESSION["cart"];

        $orderId = $cart->saveCart($address, $phone, $creditcard, $csv, $email, $expiry, $firstName, $lastName, $nameOnCard);
        session_destroy();
    }

    $productsHeading = "Order Confirmation";
    ob_start();
    $noProducts = "";
    
    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";

    include "templates/confirmation.html.php";


    $output = ob_get_clean();

    include "templates/layout.html.php";

?>