<?php
    require_once "classes/DBAccess.php";
    require_once "classes/ShoppingCart.php";

    $title = "Insert";
    $pageHeading = "Insert Employee";
    
    session_start();

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

    $cartNumber = $cart->count();

    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";
    include "templates/productNavigation.html.php";

    $getFeatured = "SELECT itemId, itemName, photo, price, salePrice FROM item WHERE featured = 1";

    $productsHeading = "Featured Products";

    $featured = $pdo->prepare($getFeatured);
    $products = $db->executeSQL($featured);

    include "templates/slideshow.html.php";
    
    include "templates/products.html.php";
    include "templates/showSponsers.html.php";
    include "templates/siteFooter.html.php";



    $output = ob_get_clean();

    include "templates/layout.html.php";
?>