<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Authentication.php";

    session_start();

    include "settings/db.php";

    $db = new DBAccess($dsn, $username, $password);

    $pdo = $db->connect();

    $getCategory = "SELECT categoryId, categoryName FROM category";

    $categoryStatement = $pdo->prepare($getCategory);

    $category = $db->executeSQL($categoryStatement);

    $cartNumber = 0;

    $title = "Thanks";
    $orderId = 0;
    $errorMessage = "";
    $message = "";
    $error = false;

    $productsHeading = "Update Products";
    ob_start();
    $noProducts = "";

    $data = "";


    Authentication::protect();

    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";

    $productsQuery = "SELECT itemId, itemName, photo, price, saleprice, description, featured, item.categoryId, category.categoryName FROM item, category WHERE category.categoryId = item.categoryId";
    $productsStatement = $pdo->prepare($productsQuery);

    $products = $db->executeSQL($productsStatement);

    if(isset($_POST["edit"])) {
        $productId = $_POST["productId"];
        
        foreach ($products as $item) {
            if($item["itemId"] == $productId) {
                $data = $item;
            }
        }
    }

    if(isset($_POST['insert'])) {
        $data = "new";
    }

    if(isset($_POST["addNew"])) {
        $itemName = $_POST["itemName"];
        $itemPrice = sprintf('%01.2f', $_POST["itemPrice"]);
        if(!empty($_POST['salePrice'])) {
            $salePrice = sprintf('%01.2f', $_POST['salePrice']);
        } else {
            $salePrice = 0.00;
        }

        $description = $_POST["description"];
        print_r($_POST["categoryId"]);  

        $categoryId = $_POST["categoryId"];

        if(isset($_POST['featured'])) {
            $featured = 1;
        } else {
            $featured = 0;
        }

        $directory = "assets/images/";

        $photoPath = basename($_FILES["productImage"]["name"]);

        $file = $directory . $photoPath;
        $imageFileType = pathinfo($file, PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
        {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $error = true;
        }
            
        if ($_FILES["productImage"]["error"] == 1)
        {
            $message = "Sorry, your file is too large. Max of 2M is allowed.";
            $error = true;
        }
        if($error == false)
        {
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $file))
            {
                $message = "The file has been uploaded.";
            }
            else
            {
                $message = "Sorry, there was an error uploading your file. Error Code:" .
                $_FILES["productImage"]["error"];
                $photoPath = "";
            }
        }
        else
        {
            $photoPath = "";
        }
        $insertQuery = "INSERT INTO item (itemName, photo, price, salePrice, description, featured, categoryId) VALUES (:itemName, :photo, :price, :salePrice, :description, :featured, :categoryId)";
        
        $insert = $pdo->prepare($insertQuery);

        $insert->bindParam(":itemName", $itemName, PDO::PARAM_STR);
        $insert->bindParam(":photo", $photoPath, PDO::PARAM_STR);
        $insert->bindParam(":price", $itemPrice, PDO::PARAM_STR);
        $insert->bindParam(":salePrice", $salePrice, PDO::PARAM_STR);
        $insert->bindParam(":description", $description, PDO::PARAM_STR);
        $insert->bindParam(":featured", $featured, PDO::PARAM_INT);
        $insert->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);

        $db->executeNonQuery($insert);
    }

    if(isset($_POST["update"])) {
        $itemId = $_POST["itemId"];
        $itemName = $_POST["itemName"];
        $itemPrice = sprintf('%01.2f', $_POST["itemPrice"]);
        if(!empty($_POST['salePrice'])) {
            $salePrice = sprintf('%01.2f', $_POST['salePrice']);
        } else {
            $salePrice = 0.00;
        }
        $description = $_POST["description"];
        if(empty($_POST["categoryId"])) {
            $categoryId = $_POST["hiddenCategory"];
        } else {
            $categoryId = $_POST["categoryId"];
        }

        if(isset($_POST['featured'])) {
            $featured = 1;
        } else {
            $featured = 0;
        }

        if(!empty($_FILES)) {
            $directory = "assets/images/";

            $photoPath = basename($_FILES["productImage"]["name"]);
    
            $file = $directory . $photoPath;
            $imageFileType = pathinfo($file, PATHINFO_EXTENSION);
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
                $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $error = true;
            }
                
            if ($_FILES["productImage"]["error"] == 1)
            {
                $message = "Sorry, your file is too large. Max of 2M is allowed.";
                $error = true;
            }
            if($error == false)
            {
                if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $file))
                {
                    $message = "The file has been uploaded.";
                }
                else
                {
                    $message = "Sorry, there was an error uploading your file. Error Code:" .
                    $_FILES["productImage"]["error"];
                    $photoPath = "";
                }
            }
            else
            {
                $photoPath = "";
            }
        } else {
            $photoPath = $_POST["hiddenImage"];
        }
        
        if($photoPath == "") {
            $photoPath = $_POST["hiddenImage"];
        }

       
        $insertQuery = "UPDATE item SET itemName = :itemName, photo = :photo, price = :price, salePrice = :salePrice, description = :description, featured = :featured, categoryId = :categoryId WHERE itemId = :itemId";
        
        $insert = $pdo->prepare($insertQuery);

        $insert->bindParam(":itemName", $itemName, PDO::PARAM_STR);
        $insert->bindParam(":photo", $photoPath, PDO::PARAM_STR);
        $insert->bindParam(":price", $itemPrice, PDO::PARAM_STR);
        $insert->bindParam(":salePrice", $salePrice, PDO::PARAM_STR);
        $insert->bindParam(":description", $description, PDO::PARAM_STR);
        $insert->bindParam(":featured", $featured, PDO::PARAM_INT);
        $insert->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
        $insert->bindParam(":itemId", $itemId, PDO::PARAM_INT);

        $db->executeNonQuery($insert);
    }
    include "templates/adminCustomization.html.php";

    include "templates/editProducts.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";

?>