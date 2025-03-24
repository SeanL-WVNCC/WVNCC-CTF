<?php
/*
    daskboard.php
    Page for users to manage their finances. 
*/
session_start();
include "include/functions.php";

$mainContent = "";
if(isLoggedIn()) {
    $leftColumn = "";
    $rightColumn = "";
    $account = bankAccountFromAccountNumber($_GET["account-number"]);
    $accountNumber = $account->accountNumber;
    $leftColumn .= "<div class=\"account-card-container\">";
    $leftColumn .= "<h2>Account details</h2>";
    $leftColumn .= "<p>This account hasn't had any transactions yet.</p>";
    $leftColumn .= "<p>$accountNumber</p>";
    $leftColumn .= "</div>";
    $mainContent .= twoColumnLayout($leftColumn, $rightColumn);
    echo generatePage($mainContent);
}