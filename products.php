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


    if(isset($_GET['category']) || isset($_POST["searchterm"])) {
        if(isset($_POST["searchterm"])) {
            $getProducts = "SELECT itemId, itemName, photo, price, salePrice FROM item WHERE itemName LIKE :SearchTerm";

            $getItems = $pdo->prepare($getProducts);

            $getItems->bindValue(":SearchTerm", "%" . $_POST["searchterm"] . "%", PDO::PARAM_STR);

            $products = $db->executeSQL($getItems);

            $productsHeading = "Search Results: " . $_POST["searchterm"];

            if($products == null) {
                $noProducts = "No Products found for the search " . $_POST["searchterm"];
            }

        } else {
            $getProducts = "SELECT itemId, itemName, photo, price, salePrice FROM item WHERE categoryId = :CategoryId";

            $getItems = $pdo->prepare($getProducts);

            $getItems->bindValue(":CategoryId", $_GET["category"], PDO::PARAM_STR);

            $products = $db->executeSQL($getItems);

            $categoryName;
            foreach ($category as $cat) {
                if($cat['categoryId'] == $_GET['category']) {
                    $categoryName = $cat['categoryName'];
                }
            }
            
            $productsHeading = $categoryName;
        }

    } else {
        $getProducts = "SELECT itemId, itemName, photo, price, salePrice FROM item";

        $getItems = $pdo->prepare($getProducts);

        $products = $db->executeSQL($getItems);

        $productsHeading = "All Products";
    }

    
    
    include "templates/products.html.php";
    include "templates/showSponsers.html.php";
    include "templates/siteFooter.html.php";



    $output = ob_get_clean();

    include "templates/layout.html.php";
?>