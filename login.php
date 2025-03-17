<?php
// Login Form.

session_start();
include "include/functions.php";
include "include/formgen.php";

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
$loginForm = new SimpleForm(
    name: "Login",
    fields: array(
        new SimpleFormField(
            type: "username",
            name: "text",
            accessibleName: "Username",
            errorMessage: $usernameError,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "password",
            accessibleName: "Password",
            errorMessage: $passwordError,
            autofocus: false,
            isRequired: true)
        ),
    instructions: "Here are some instructions on how to use the form. Good luck!",
    method: "POST",
    action: "/login.php",
    submitButtonName: "Login"
);
$mainContent .= $loginForm->generateHtml();

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
