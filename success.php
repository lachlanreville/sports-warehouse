<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Authentication.php";

    session_start();

    $cartNumber = 0;

    $title = "Thanks";
    $orderId = 0;
    $errorMessage = "";

    $productsHeading = "Success";
    ob_start();
    $noProducts = "";

    Authentication::protect();

    include "templates/siteNavigation.html.php";
    include "templates/mainHeading.html.php";

    include "templates/adminCustomization.html.php";

    include "templates/loggedin.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";

?>