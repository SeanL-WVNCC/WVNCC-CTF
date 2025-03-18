<?php
session_start();
include "include/functions.php";
include "include/formgen.php";

$mainContent = "";
// Print the form.
$registrationForm = new SimpleForm(
    name: "Register",
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
            type: "retype-password",
            name: "password",
            accessibleName: "Retype password",
            errorMessage: "",
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "email",
            name: "email",
            accessibleName: "Email",
            errorMessage: "",
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
    $mainContent .= "<div class=\"single-column\" role=\"presentation\">";
    $mainContent .= "<h2>Thanks for choosing Northern Phish &amp; Loan!</h2>";
    $mainContent .= "<p>Stop by your local branch to finish setting up your account.</p>";
    $mainContent .= "</div>";
} else {
    $mainContent .= $registrationForm->generateHtml();
}
echo generatePage($mainContent);