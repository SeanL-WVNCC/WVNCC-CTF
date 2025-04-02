<?php
/*
    open-account.php
    POST endpoint for opening of new bank accounts. Associated form is on the dashboard.
*/
session_start();
include "include/functions.php";

$user = getCurrentUser();
if(!$user) {
    // Not logged in? Go away!
    header("Location: /login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!isset($_POST["account-type"]) || !isset($_POST["account-nickname"])) {
        // User somehow bypassed the client-side verification, should never happen
        $errorMessage = "<h2>Could Not Open Account</h2>";
        $errorMessage .= "<p class=\"error-block\">We were unable to open your account because of a technical problem on our end. We apologize for the inconvience and will work to fix the problem shortly.</p>";
        $errorMessage .= "<p>[400 Error: required POST parameters not set]</p>";
        http_response_code(400);
        echo generatePage(singleColumnLayout($errorMessage));
        exit();
    }
    insertAccountIntoDb(new BankAccount(0, $user->userId, AccountType::fromString($_POST["account-type"]), $_POST["account-nickname"]));
} else {
    header("Location: /dashboard.php");
}
header("Location: /dashboard.php");