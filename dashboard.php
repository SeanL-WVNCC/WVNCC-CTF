<?php
/*
    daskboard.php
    Page for users to manage their finances. 
*/
session_start();
include "include/functions.php";

$mainContent = "";
if(isLoggedIn()) {
    $user = userFromId($_COOKIE["logged-in-user"]);
    $mainContent .= "<div class=\"two-column\" role=\"presentation\">";
    $mainContent .= "<div class=\"account-card-container\">";
    $mainContent .= "<h2>Hello, ".$user->firstName."!</h2>";
    $mainContent .= generateAccountCard("Joe's", "3456", 7, "/account.php?account-number=1234567890");
    $mainContent .= "</div>";
    $loginForm = new SimpleForm(
        name: "Open Another Account",
        fields: array(
            new SimpleFormField(
                type: "text",
                name: "account-type",
                accessibleName: "Account Type",
                errorMessage: "",
                validationIcon: "",
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "text",
                name: "account-nickname",
                accessibleName: "Account Nickname",
                errorMessage: "",
                validationIcon: "",
                autofocus: false,
                isRequired: false
            ),
        ),
        instructions: "Ready to open another bank account? Submit the following form to begin.",
        method: "POST",
        action: "/login.php",
        submitButtonName: "Open Account"
    );
    $mainContent .= $loginForm->generateHtml();
    $mainContent .= "</div>";
    echo generatePage($mainContent);
}