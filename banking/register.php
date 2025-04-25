<?php
/*
    register.php
    Dummy page for registering for the site.
*/
session_start();
include "/var/www/html/include/functions.php";

$mainContent = "";
$registrationForm = new SimpleForm(
    name: "Register",
    fields: array(
        new SimpleFormField(
            type: "text",
            name: "username",
            accessibleName: "Username",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "password",
            accessibleName: "Password",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "password",
            name: "retype-password",
            accessibleName: "Retype password",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "email",
            name: "email",
            accessibleName: "Email",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        )
    ),
    instructions: "Fill the following form to create your Northern Phish &amp; Loan mobile banking account. Once completed, you will need to go to your local Northern Phish branch to complete setup.",
    method: "POST",
    action: "/register.php",
    submitButtonName: "Register"
);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    // If POST, send message...
    $mainContent .= "<div class=\"single-column\" role=\"presentation\">";
    $mainContent .= "<h2>Thanks for choosing Northern Phish &amp; Loan!</h2>";
    $mainContent .= "<p>Stop by your local branch to finish setting up your account.</p>";
    $mainContent .= "</div>";
} else {
    // Otherwise, show form
    $mainContent .= $registrationForm->generateHtml();
}
echo generatePage($mainContent);