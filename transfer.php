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
            defaultValue: "",
            options: array("Checking", "Saving"),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "select",
            name: "to-account",
            accessibleName: "Recieving Account",
            defaultValue: "",
            options: array(
                "checking" => "Checking", 
                "saving" => "Saving"
            ),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "number",
            name: "amount",
            accessibleName: "Amount",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
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