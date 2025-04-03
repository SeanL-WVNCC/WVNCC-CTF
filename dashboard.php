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
    $leftColumn = "";
    $rightColumn = "";
    $leftColumn .= "<div class=\"account-card-container\">";
    $leftColumn .= "<h2>Hello, ".$user->firstName."!</h2>";
    $accounts = bankAccountsFromUser(getCurrentUser()->userId);
    if($accounts) {
        $leftColumn .= generateAccountCards($accounts, True);
        $formTitle = "Open Another Account";
        $formInstructions = "Ready to open another bank account? Submit the following form to begin.";
    } else {
        $leftColumn .= "<p class=\"single-column\">It seems that you don't have a bank account at Northern Phish yet. When you open one, it'll show up here.</p>";
        $formTitle = "Open Bank Account";
        $formInstructions = "Submit the following form to create your first bank account with Northern Phish.";
    }
    global $susIcon;
    // TODO: rethink the way this form is processed.
    // As it currently stands, getting error messages here would be tricky.
    $leftColumn .= "</div>";
    $loginForm = new SimpleForm(
        name: $formTitle,
        fields: array(
            new SimpleFormField(
                type: "select",
                name: "account-type",
                accessibleName: "Account Type",
                defaultValue: "",
                options: array("Checking", "Saving", "Dark Vault Credit", "Morgage"),
                errorMessage: "",
                validationIcon: null,
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "text",
                name: "account-nickname",
                accessibleName: "Account Nickname",
                defaultValue: "",
                options: array(),
                errorMessage: "",
                validationIcon: null,
                autofocus: false,
                isRequired: true
            ),
        ),
        instructions: $formInstructions,
        method: "POST",
        action: "/open-account.php",
        submitButtonName: "Open Account"
    );
    $rightColumn .= $loginForm->generateHtml();
    $mainContent .= twoColumnLayout($leftColumn, $rightColumn);
    echo generatePage($mainContent);
} else {
    header("Location: /login.php");
}