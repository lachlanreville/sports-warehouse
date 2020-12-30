<?php
    require_once "classes/ShoppingCart.php";

    $title = "Insert";
    $pageHeading = "Insert Employee";

    session_start();

    $message = "";
    $error = false;

    ob_start();

    if(!isset($_SESSION["cart"])) 
    {
        $cart = new ShoppingCart();
    } 
    else 
    {
        $cart = $_SESSION["cart"];
    }

    $cartNumber = $cart->count();

    if(isset($_POST["submit"])) {
        $requiredFields = ["firstName", "lastName", 'emailAddress'];

        $missingFields = [];

        foreach($requiredFields as $field) {
            if (!isset($_POST[$field]) || !$_POST[$field]) {
                $missingFields[] = $field;
            }
        }
        
        if($missingFields) {
            $message = "Some fields are missing. Please fill out the fields with an * next to it.";
        } else {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["emailAddress"];
            $phoneNumber = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : false;

            $question = isset($_POST["question"]) ? $_POST["question"] : false;

            if($question != false) {
                if($phoneNumber) {
                    $message = "Thanks " . $firstName . " " . $lastName . " you will be contacted via email (" . $email . ") or phone (" . $phoneNumber . ") regarding your question: " . $question;
                } else {
                    $message = "Thanks " . $firstName . " " . $lastName . " you will be contacted via email (" . $email . ") regarding your question: " . $question;
                }
                
            } else {
                if($phoneNumber) {
                    $message = "Thanks " . $firstName . " " . $lastName . " you will be contacted via email (" . $email . ") or phone (" . $phoneNumber . ")";
                } else {
                    $message = "Thanks " . $firstName . " " . $lastName . " you will be contacted via email (" . $email . ")";
                }
            }   
        }


    }

    include "templates/siteNavigation.html.php";
    include "templates/contactUs.html.php";
    
    $output = ob_get_clean();

    include "templates/layout.html.php";
?>