<?php
    require_once "classes/DBAccess.php";

    session_start();

    $title = "Insert";
    $pageHeading = "Insert Employee";

    include "settings/db.php";

    $db = new DBAccess($dsn, $username, $password);

    $pdo = $db->connect();

    $productsHeading = "Featured Products";
    ob_start();
    $noProducts = "";

    if(isset($_POST["execute"])) 
    {
        $runQuery = $pdo->prepare($_POST["runQuery"]);
        $category = $db->executeSQL($runQuery);
        print_r($category);
        
    } 
    
    include "templates/executeQuery.html.php";


    $output = ob_get_clean();

    include "templates/layout.html.php";
?>