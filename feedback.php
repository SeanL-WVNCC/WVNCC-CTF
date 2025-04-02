<?php
/*
    feedback.php
    TODO: This page should submit feedback as described by
    Grant's feature request.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$feedbackForm = new SimpleForm(
    name: "Feedback",
    fields: array(
        new SimpleFormField(
            type: "text",
            name: "first-name",
            accessibleName: "First Name",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: true,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "last-name",
            accessibleName: "Last Name",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "email",
            accessibleName: "Email",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "subject",
            accessibleName: "Subject",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "feedback",
            accessibleName: "Feedback",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        )
    ),
    instructions: "Here you can send any feedback you have for us!",
    method: "POST",
    action: "/feedback.php",
    submitButtonName: "Send"
);
$mainContent .= $feedbackForm->generateHtml();
echo generatePage($mainContent);
