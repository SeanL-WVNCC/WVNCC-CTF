<?php
session_start();
include "include/functions.php";
$mainContent = "";
include "include/vulnconfig.php";
$usernameIsSuspect = false;
$passwordIsSuspect = false;
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $usernamePayload = new PayloadCharacteristics($_POST["username"]);
    $passwordPayload = new PayloadCharacteristics($_POST["password"]);
    $usernameIsSuspect = $usernamePayload->isSuspect();
    $passwordIsSuspect = $passwordPayload->isSuspect();
}
$mainContent .= "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"login.php\">";
$mainContent .= "<h2 id=\"login-heading\">Login</h2>";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" ";
if($usernameIsSuspect) {
    $mainContent .= "class=\"sussy\"";
}
$mainContent .= " type=\"text\" name=\"username\" autofocus required>";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" ";
if($passwordIsSuspect) {
    $mainContent .= "class=\"sussy\"";
}
$mainContent .= "< type=\"password\" name=\"password\" required>";
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
            $mainContent .= "<p>$authResult->statusMessage</p>";
    } catch (mysqli_sql_exception $error) {
        $mainContent .= "<div>Invalid SQL: <samp>SELECT * FROM users WHERE username=\"<u>$username\"</u></samp></div>";
        if(str_starts_with($username, '"')) {
            $mainContent .= "<div>Content following quote appears to be invalid.</div>";
        }
    }
}
//$mainContent .= "<div class=\"sus-meter\" role=\"presentation\"><meter min=\"0\" max=\"5\" value=\"3\"></div>";
$mainContent .= "</form>";
echo generatePage($mainContent);
