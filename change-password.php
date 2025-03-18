<?php
session_start();
include "include/functions.php";
include "include/formgen.php";
$mainContent = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_COOKIE["is-logged-in"])){
        $conn = connectToDatabase();
        $password = $_POST["new-password"];
        $userId = $_COOKIE["logged-in-user"];
        $query = "UPDATE users SET password=\"$password\" WHERE userId=\"$userId\"";
        $conn->query($query);
        header("Location: /about.php");
    } else {
        header("Location: /about.php");
    }
} else {
    $passwordChangeFormForm = new SimpleForm(
        name: "Change Password",
        fields: array(
            new SimpleFormField(
                type: "username",
                name: "text",
                accessibleName: "Username",
                errorMessage: "",
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "password",
                name: "password",
                accessibleName: "Password",
                errorMessage: "",
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "password",
                name: "new-password",
                accessibleName: "New password",
                errorMessage: "",
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "retype-password",
                name: "password",
                accessibleName: "Retype password",
                errorMessage: "",
                autofocus: false,
                isRequired: true
            ),
        ),
        instructions: "",
        method: "POST",
        action: "/login.php",
        submitButtonName: "Login"
    );
    $mainContent .= $passwordChangeFormForm->generateHtml();
}

echo generatePage($mainContent);