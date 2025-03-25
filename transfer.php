<?php 
include "include/functions.php";
session_start();

$transferForm = new SimpleForm(
    name: "Transfer Funds",
    fields: array(
        new SimpleFormField(
            type: "select",
            name: "from-account",
            accessibleName: "Sending account",
            options: array("Checking", "Saving"),
            errorMessage: "",
            validationIcon: "",
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "select",
            name: "to-account",
            accessibleName: "Recieving Account",
            options: array(
                "checking" => "Checking", 
                "saving" => "Saving"
            ),
            errorMessage: "",
            validationIcon: "",
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "number",
            name: "amount",
            accessibleName: "Amount",
            options: array(),
            errorMessage: "",
            validationIcon: "",
            autofocus: false,
            isRequired: true
        ),
    ),
    instructions: "",
    method: "POST",
    action: "/open-account.php",
    submitButtonName: "Transfer Funds"
);
$mainContent = "";
$mainContent .= $transferForm->generateHtml();
echo generatePage($mainContent);