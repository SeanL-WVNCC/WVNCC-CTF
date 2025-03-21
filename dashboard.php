<?php
/*
    daskboard.php
    Page for users to manage their finances. 
*/
session_start();
include "include/functions.php";

$mainContent = "";
if(isLoggedIn()) {
    $user = userFromId($_COOKIE["logged-in-user"]);
    $mainContent .= "<div class=\"single-column\" role=\"presentation\">";
    $mainContent .= "<h2>Hello, ".$user->firstName."!</h2>";
    $mainContent .= "<div class=\"account-card\"><img src=\"img/bank-icon.svg\"><div class=\"account-type-section\"><p class=\"account-name\">Checking account</p><p>Account #3479</p></div><div class=\"account-balance-section\"><p class=\"account-balance\">$3,467.02</p><p>Current balance</p></div></div>";
    $mainContent .= "</div>";
    echo generatePage($mainContent);
}