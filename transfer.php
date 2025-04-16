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
            isRequired: true
        ),
        new SimpleFormField(
            type: "number",
            name: "amount",
            accessibleName: "Amount",
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