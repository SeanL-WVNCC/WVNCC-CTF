<?php
/*
    open-account.php
    POST endpoint for opening of new bank accounts. Associated form is on the dashboard.
*/
session_start();
include "include/functions.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    insertAccountIntoDb(new BankAccount(0, getCurrentUser()->userId, AccountType::fromString($_POST["account-type"]), $_POST["account-nickname"]));

} else {
    header("Location: /dashboard.php");
}
header("Location: /dashboard.php");