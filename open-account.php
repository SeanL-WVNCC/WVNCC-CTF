<?php
/*
    open-account.php
    POST endpoint for opening of new bank accounts. Associated form is on the dashboard.
*/
session_start();
include "include/functions.php";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $mainContent = "";
    $mainContent .= singleColumnLayout("Hi");
    echo generatePage($mainContent);

} else {
    header("Location: /dashboard.php");
}