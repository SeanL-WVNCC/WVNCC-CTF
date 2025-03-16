<?php
// Login Form.

session_start();
include "include/functions.php";

// Init variables.
$mainContent = "";
$usernameIsSuspect = false;
$passwordIsSuspect = false;
$usernamePayload = null;
$passwordPayload = null;
$authResult = null;
$usernameError = "";
$passwordError = "";

// If form was submitted...
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $usernamePayload = new PayloadCharacteristics($_POST["username"]);
    $passwordPayload = new PayloadCharacteristics($_POST["password"]);
    $usernameIsSuspect = $usernamePayload->isSuspect();
    $passwordIsSuspect = $passwordPayload->isSuspect();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $authResult = authenticate($username, $password);
    if($authResult->isSuccess) {
        login($authResult->userId);
        header("Location: /");
    }
    $usernameError = $authResult->usernameErrorMessage;
    $passwordError = $authResult->passwordErrorMessage;
}
// Print the form.
$mainContent .= "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"login.php\">";
$mainContent .= "<h2 id=\"login-heading\">Login</h2>";
$mainContent .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" ";
if($usernameIsSuspect) {
    $mainContent .= "class=\"sussy\"";
}
$mainContent .= " type=\"text\" name=\"username\" ";
if(1) {
    $mainContent .= "aria-describedby=\"username-error-message\"";
}
$mainContent .= " autofocus required>";
if(1) {
    $mainContent .= "<div id=\"username-error-message\" class=\"form-error-message\" aria-live=\"polite\">$usernameError</div>";
}
$mainContent .= "</div>";
$mainContent .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" ";
if($passwordIsSuspect) {
    $mainContent .= " class=\"sussy\" ";
}
$mainContent .= " type=\"password\" name=\"password\" ";
if(1) {
    $mainContent .= " aria-describedby=\"password-error-message\" ";
}
$mainContent .= " required>";
if(1) {
    $mainContent .= "<div id=\"password-error-message\" class=\"form-error-message\" aria-live=\"polite\">$passwordError</div>";
}
$mainContent .= "</div>";
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
