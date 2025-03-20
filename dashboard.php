<?php
/*
    daskboard.php
    Page for users to manage their finances. 
*/
session_start();
include "include/functions.php";

$mainContent = "";
$user = userFromId($_COOKIE["logged-in-user"]);
$mainContent .= "Hello, ".$user["firstName"]."!";
echo generatePage($mainContent);