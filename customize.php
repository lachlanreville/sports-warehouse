<?php
    require_once "classes/DBAccess.php";
    require_once "classes/CartItem.php";
    require_once "classes/ShoppingCart.php";

    session_start();

    $title = "Insert";
    $pageHeading = "Insert Employee";

    include "settings/db.php";

    $db = new DBAccess($dsn, $username, $password);

    $pdo = $db->connect();

    $message = "";
    $error = false;

    if(!isset($_SESSION["cart"])) 
    {
        $cart = new ShoppingCart();
    } 
    else 
    {
        $cart = $_SESSION["cart"];
    }

    if(isset($_POST['submit'])) {
        $_SESSION['background'] = $_POST["background"];
    }
    

    include "templates/mainHeading.html.php";
    include "templates/adminCustomization.html.php";
    include "templates/customize.html.php";


    include "templates/siteFooter.html.php";


    $output = ob_get_clean();

    include "templates/layout.html.php";
?>