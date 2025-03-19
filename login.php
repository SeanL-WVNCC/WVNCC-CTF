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
    $formInstructions .= $authResult->statusMessage;
}

// Print the form.
$loginForm = new SimpleForm(
    name: "Login",
    fields: array(
        new SimpleFormField(
            type: "type",
            name: "username",
            accessibleName: "Username",
            errorMessage: $usernameError,
            validationIcon: $usernameIsSuspect ? "sussy" : "",
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "password",
            accessibleName: "Password",
            errorMessage: $passwordError,
            validationIcon: $passwordIsSuspect ? "sussy" : "",
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
    $username = $_POST["username"];
    $password = $_POST["password"];
    $authResult = authenticate($username, $password);
    if($authResult->isSuccess) {
        login($authResult->userId);
        header("Location: /");
    }
}
$mainContent .= "</form>";
echo generatePage($mainContent);
