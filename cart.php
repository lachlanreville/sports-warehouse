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

    $getCategory = "SELECT categoryId, categoryName FROM category";

    $categoryStatement = $pdo->prepare($getCategory);

    $category = $db->executeSQL($categoryStatement);

    $productsHeading = "Featured Products";
    ob_start();
    $noProducts = "";

    if(!isset($_SESSION["cart"])) 
    {
        $cart = new ShoppingCart();
    } 
    else 
    {
        $cart = $_SESSION["cart"];
    }
    
    $cartItems = $cart->getItems();

    $cartNumber = $cart->count();

    $totalPrice = $cart->calculateTotal();

    if(isset($_POST["remove"])) {
        if(!empty($_POST["productId"]) && isset($_SESSION["cart"]))
        {
            $productId = $_POST["productId"];

            $item = new CartItem("", 0, 0, $productId);

            $cart->removeItem($item);

            $_SESSION["cart"] = $cart;
        }
    }


    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";
    include "templates/productNavigation.html.php";


    include "templates/cart.html.php";
    include "templates/siteFooter.html.php";


    $output = ob_get_clean();

    include "templates/layout.html.php";
?>