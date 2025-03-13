<?php
session_start();
include "include/functions.php";
$mainContent = "";
include "include/vulnconfig.php";
$mainContent .= "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"login.php\">";
$mainContent .= "<h2 id=\"login-heading\">Login</h2>";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" type=\"text\" name=\"username\" autofocus required>";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" type=\"password\" name=\"password\" required>";
$mainContent .= "<button type=\"submit\">Login</button>";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $authResult = authenticate($username, $password);
            if($authResult->isSuccess) {
                login($authResult->userId);
                header("Location: /");
            }
            $mainContent .= $authResult->statusMessage;
    } catch (mysqli_sql_exception $error) {
        $mainContent .= "<div>Invalid SQL: <samp>SELECT * FROM users WHERE username=\"<u>$username\"</u></samp></div>";
        if(str_starts_with($username, '"')) {
            $mainContent .= "<div>Content following quote appears to be invalid.</div>";
        }
    }
}
$mainContent .= "</form>";
echo generatePage($mainContent);
