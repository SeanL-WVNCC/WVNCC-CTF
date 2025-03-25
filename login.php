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
$formInstructions = "";

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
    $statusMessage = $authResult->statusMessage;
    $formInstructions .= $statusMessage;
}

global $susIcon;
// Print the form.
$loginForm = new SimpleForm(
    name: "Login",
    fields: array(
        new SimpleFormField(
            type: "text",
            name: "username",
            accessibleName: "Username",
            options: array(),
            errorMessage: $usernameError,
            validationIcon: $usernameIsSuspect ? $susIcon : null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "password",
            accessibleName: "Password",
            options: array(),
            errorMessage: $passwordError,
            validationIcon: $passwordIsSuspect ? $susIcon : null,
            autofocus: false,
            isRequired: true
        )
    ),
    instructions: $formInstructions,
    method: "POST",
    action: "/login.php",
    submitButtonName: "Login"
);
$mainContent .= $loginForm->generateHtml();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!isset($_POST["username"]) || !isset($_POST["password"])) {
        $errorMessage = "<h2>Could Not Log in</h2>";
        $errorMessage .= "<p class=\"error-block\">We were unable to log you in because of a technical problem on our end. We apologize for the inconvience and will work to fix the problem shortly.</p>";
        $errorMessage .= "<p>[400 Error: required POST parameters not set]</p>";
        http_response_code(400);
        echo generatePage(singleColumnLayout($errorMessage));
        exit();
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $authResult = authenticate($username, $password);
    if($authResult->isSuccess) {
        login($authResult->userId);
        header("Location: /dashboard.php");
    }
}
$mainContent .= "</form>";
echo generatePage($mainContent);
