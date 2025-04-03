<?php
/*
    login.php
    A simple login form.
*/
session_start();
include "include/functions.php";

// Init variables.
$username = "";
$password = "";
$authResult = null;
$usernameError = "";
$passwordError = "";
$formInstructions = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // If form was submitted...
    if(!isset($_POST["username"]) || !isset($_POST["password"])) {
        // 1. Make sure all of the fields are present.
        // (This code *should* never run)
        $errorMessage = "<h2>Could Not Log in</h2>";
        $errorMessage .= "<p class=\"error-block\">We were unable to log you in because of a technical problem on our end. We apologize for the inconvience and will work to fix the problem shortly.</p>";
        $errorMessage .= "<p>[400 Error: required POST parameters not set]</p>";
        http_response_code(400);
        echo generatePage(singleColumnLayout($errorMessage));
        exit();
    }

    // 2. Read the submitted values.
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 3. Check username + password against DB.
    $authResult = authenticate($username, $password);
    if($authResult->isSuccess) {
        // 3.1. If correct, login. Otherwise continue.
        login($authResult->userId);
        header("Location: /dashboard.php");
    }
    // 3.2. Login failed, collect error messages.
    $usernameError = $authResult->usernameErrorMessage;
    $passwordError = $authResult->passwordErrorMessage;
    $formInstructions = $authResult->statusMessage;
}

$usernamePayload = new PayloadCharacteristics($username);
$passwordPayload = new PayloadCharacteristics($password);
global $susIcon;
$loginForm = new SimpleForm(
    name: "Login",
    fields: array(
        new SimpleFormField(
            type: "text",
            name: "username",
            accessibleName: "Username",
            defaultValue: "",
            options: array(),
            errorMessage: $usernameError,
            validationIcon: $usernamePayload->isSuspect() ? $susIcon : null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "password",
            accessibleName: "Password",
            defaultValue: "",
            options: array(),
            errorMessage: $passwordError,
            validationIcon: $passwordPayload->isSuspect() ? $susIcon : null,
            autofocus: false,
            isRequired: true
        )
    ),
    instructions: $formInstructions,
    method: "POST",
    action: "/login.php",
    submitButtonName: "Login"
);

echo generatePage($loginForm->generateHtml());
