<?php
    require_once "classes/DBAccess.php";
    require_once "classes/CartItem.php";
    require_once "classes/ShoppingCart.php";

    session_start();

    $title = "Insert";
    $pageHeading = "Insert Employee";

    if(!isset($_SESSION["cart"])) 
    {
        $cart = new ShoppingCart();
    } 
    else 
    {
        $cart = $_SESSION["cart"];
    }

    $cartNumber = $cart->count();

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

    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";
    include "templates/productNavigation.html.php";


    if(isset($_GET['product'])) {
            $getProducts = "SELECT itemId, itemName, photo, price, salePrice, description FROM item WHERE itemId = :productId";

            $getItems = $pdo->prepare($getProducts);

            $getItems->bindValue(":productId", $_GET["product"], PDO::PARAM_STR);

            $products = $db->executeSQL($getItems);

    } else {
        header("Location: http://localhost/Sports%20Warehouse%20Deliverable%20C/index.php", true, 301);
        exit();
    }

    if(isset($_POST["addtocart"])) {
        $quantity = $_POST["quantity"];

        $productName = $products[0]["itemName"];
        if($products[0]["salePrice"] != null && $products[0]["salePrice"] > 0.00) {
            $price = $products[0]["salePrice"];
        } else {
            $price = $products[0]["price"];
        }

        if($quantity < 1) {
            $message = "Quantity cant be less than 1";
            $error = true;
        }

        $productId = $products[0]["itemId"];

        $productImage = $products[0]["photo"];
        if($error == false) {
            $item = new CartItem($productName, $quantity, $price, $productId, $productImage);

            if(!isset($_SESSION["cart"])) 
            {
                $cart = new ShoppingCart();
            } 
            else 
            {
                $cart = $_SESSION["cart"];
            }

            $cart->addItem($item);

            $_SESSION["cart"] = $cart;

            $message = "Added item to cart";

        }
    }

    include "templates/individualProduct.html.php";
    include "templates/siteFooter.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>