<?php
/*
    mobile-deposit.php
    Form for uploading check photographs.
    FIXME: I cannot upload files larger than 1 MB or so, the page crashes
    and does not congratulate me as it should. -Sean
*/
session_start();
include "include/functions.php";

$mainContent = "";
$error = "";
$status = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    // Format Restrictions
    $fileSizeLimitByte = 15000000; // File size is bytes. Equals to 15MB
    $maxFileSize = 50000000; // File size is bytes. Equals to 50MB
    $fileSizeLimitMB = $fileSizeLimitByte / 1000000;
    $allowedFileTypesStr = implode(", ", $permittedFileTypes);

    // Directory for Upload Files
    $fileUploadDirectory = "uploads/";

    // File Info
    $filename = $_FILES["file-to-upload"]["name"];
    $fileSize = $_FILES["file-to-upload"]["size"];
    $tmpFilename = $_FILES["file-to-upload"]["tmp_name"];

    // Extra vars
    $targetFile = $fileUploadDirectory . basename($filename);
    $strFileName = htmlspecialchars(basename($filename));

    // Testing if the file is under the accepted file size, if $fileSizeLimit is enabled, otherwise it skips this code
    $fileIsTooLarge = $fileSize > $fileSizeLimitByte;
    $fileIsWayTooLarge = $fileSize > $maxFileSize;
    if($useFileSizeLimit && $fileIsTooLarge) {
        $error = "Sorry, the max file size is ". $fileSizeLimitMB ."MB";
    } else if(!$useFileSizeLimit && $fileIsTooLarge) {
        sleep(10);
        $error = "Congrats! You have pulled off a DOS attack! Your file was way too big, pal!";
    } elseif(!$useFileSizeLimit && $fileIsWayTooLarge) {
        sleep(20);
        $error = "Congrats! You pulled off a DOS attack, but it was way too big for our page! So you get some extra credit!";
    }
        if(!filenameIsPermitted($strFileName)) {
            $error = "File must contain $allowedFileTypesStr - \"$strFileName\" does not.";
        }
    //Uploading Files as long as it fits in the requirements
    if($error == "") {
        if(move_uploaded_file($tmpFilename, $targetFile)) {
            $status = "The file ". htmlspecialchars(basename($filename))." has been uploaded at <code>".$fileUploadDirectory."</code>";
        } else {
            http_response_code(500);
            $status = "Our systems were unable to process your check photo, but we don't know why. Try reloading the page and re-attaching the photo.";
        }
    }
}

$mobileDepositForm = new SimpleForm(
    name: "Mobile Check Deposit",
    fields: array(
        new SimpleFormField(
            type: "file",
            name: "file-to-upload",
            accessibleName: "Select Photo",
            errorMessage: $error,
            isRequired: true
        ),
    ),
    instructions: "Snap a picture of a check and mobile deposit it here. Once the image is processed and reviewed, the funds will be deposited into your account.",
    method: "POST",
    action: "/mobile-deposit.php",
    submitButtonName: "Upload Image"
);

if($status) {
    $mobileDepositForm->instructions .= "<p>$status</p>";
}
$mainContent .= $mobileDepositForm->generateHtml();
echo generatePage($mainContent);