<?php
include "include/functions.php";
session_start();
$mainContent = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_COOKIE["is-logged-in"])){
        $conn = connectToDatabase();
        $password = $_POST["password"];
        $userId = $_COOKIE["logged-in-user"];
        $query = "UPDATE users SET password=\"$password\" WHERE userId=\"$userId\"";
        $conn->query($query);
        header("Location: /about.php");
    } else {
        header("Location: /about.php");
    }
} else {
    $mainContent .= "<form action=\"change-password.php\" method=\"POST\">";
    $mainContent .= "<label for=\"new-password-field\">New Password</label>";
    $mainContent .= "<input id=\"new-password-field\" type=\"password\" name=\"password\"/>";
    $mainContent .= "<button type=\"submit\"/>Change Password</button>";
    $mainContent .= "</form>";
}

echo generatePage($mainContent);