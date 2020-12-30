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
    $data = "";

    $productsHeading = "Update Categories";
    ob_start();
    $noProducts = "";

    Authentication::protect();

    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";

    if(isset($_POST["edit"])) {
        $categoryId = $_POST["categoryId"];

        $getCategory = "SELECT categoryId, categoryName FROM category WHERE categoryId = :categoryId";

        $getStatement = $pdo->prepare($getCategory);
        $getStatement->bindParam(":categoryId", $categoryId, PDO::PARAM_STR);
        $data = $db->executeSQL($getStatement);
    }

    if(isset($_POST["new"])) {
        $data = "new";
    }

    if(isset($_POST["editCategory"])) {
        if($_POST["editCategory"] == "add") {
            $categoryName = $_POST['categoryName'];

            $insertQuery = "INSERT INTO category (categoryName) VALUES (:categoryName)";
            $insertCategory = $pdo->prepare($insertQuery);
            $insertCategory->bindParam(":categoryName", $categoryName, PDO::PARAM_STR);
            $data = $db->executeNonQuery($insertCategory);
        } else {
            $categoryName = $_POST["categoryName"];
            $categoryId = $_POST["categoryId"];

            $updateQuery = "UPDATE category SET categoryName = :categoryName WHERE categoryId = :categoryId"; 
            $updateCategory = $pdo->prepare($updateQuery);
            $updateCategory->bindParam(":categoryName", $categoryName, PDO::PARAM_STR);
            $updateCategory->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);

            $data = $db->executeNonQuery($updateCategory);
        }
     }
    include "templates/adminCustomization.html.php";

    include "templates/editCategories.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";

?>