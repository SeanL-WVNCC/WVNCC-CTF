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
        $leftColumn .= generateAccountCards($accounts);
    } else {
        $leftColumn .= "<p class=\"single-column\">It seems that you don't have a bank account at Northern Phish yet. When you open one, it'll show up here.</p>";
    }
    //$leftColumn .= generateAccountCard("Joe's", "3456", 7, "/account.php?account-number=1234567890");
    $leftColumn .= "</div>";
    $loginForm = new SimpleForm(
        name: "Open Another Account",
        fields: array(
            new SimpleFormField(
                type: "select",
                name: "account-type",
                accessibleName: "Account Type",
                options: array("Checking", "Saving", "Dark Vault Credit", "Morgage"),
                errorMessage: "",
                validationIcon: "",
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "text",
                name: "account-nickname",
                accessibleName: "Account Nickname",
                options: array(),
                errorMessage: "",
                validationIcon: "",
                autofocus: false,
                isRequired: false
            ),
        ),
        instructions: "Ready to open another bank account? Submit the following form to begin.",
        method: "POST",
        action: "/open-account.php",
        submitButtonName: "Open Account"
    );
    $rightColumn .= $loginForm->generateHtml();
    $mainContent .= twoColumnLayout($leftColumn, $rightColumn);
    echo generatePage($mainContent);
}