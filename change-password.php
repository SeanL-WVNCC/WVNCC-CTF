<?php
/*
    change-password.php
    Form for a user to change their passsword.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$passwordError = "";
$retypePasswordError = "";
$currentPasswordPayload = new PayloadCharacteristics("");
$newPasswordPayload = new PayloadCharacteristics("");
$retypePasswordPayload = new PayloadCharacteristics("");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_COOKIE["is-logged-in"])){
        $conn = connectToDatabase();
        $currentPassword = $_POST["password"];
        $newPassword = $_POST["new-password"];
        $retypePassword = $_POST["retype-password"];
        $currentPasswordPayload = new PayloadCharacteristics($currentPassword);
        $newPasswordPayload = new PayloadCharacteristics($newPassword);
        $retypePasswordPayload = new PayloadCharacteristics($retypePassword);
        $userId = $_COOKIE["logged-in-user"];
        $user = userFromId((int)$userId);
        $passwordIsCorrect = $currentPassword == $user->password;
        $passwordsMatch = $newPassword == $retypePassword;
        if(!$passwordIsCorrect) {
            $passwordError = "Password Incorrect.";
        }
        if(!$passwordsMatch) {
            $retypePasswordError = "You must enter the same password twice.";
        }
        if($passwordIsCorrect && $passwordsMatch) {
            $query = "UPDATE users SET password=\"$newPassword\" WHERE userId=\"$userId\"";
            $conn->query($query);
            header("Location: /");
        } else {
            
        }
    } else {
        header("Location: /login.php");
    }
}   
    global $susIcon;
    $passwordChangeFormForm = new SimpleForm(
        name: "Change Password",
        fields: array(
            new SimpleFormField(
                type: "password",
                name: "password",
                accessibleName: "Current password",
                options: array(),
                errorMessage: $passwordError,
                validationIcon: $currentPasswordPayload->isSuspect() ? $susIcon : null,
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "password",
                name: "new-password",
                accessibleName: "New password",
                options: array(),
                errorMessage: "",
                validationIcon: $newPasswordPayload->isSuspect() ? $susIcon : null,
                autofocus: false,
                isRequired: true
            ),
            new SimpleFormField(
                type: "password",
                name: "retype-password",
                accessibleName: "Retype password",
                options: array(),
                errorMessage: $retypePasswordError,
                validationIcon: $retypePasswordPayload->isSuspect() ? $susIcon : null,
                autofocus: false,
                isRequired: true
            ),
        ),
        instructions: "",
        method: "POST",
        action: "/change-password.php",
        submitButtonName: "Change Password"
    );
    $mainContent .= $passwordChangeFormForm->generateHtml();


echo generatePage($mainContent);