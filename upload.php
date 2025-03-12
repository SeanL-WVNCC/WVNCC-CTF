<?php
include "include/functions.php";
include "include/vulnconfig.php";
$mainContent = "";;

// Format Restrictions
$fileSizeLimitByte = 15000000; // File size is bytes. Equals to 15MB
$maxFileSize = 50000000; // File size is bytes. Equals to 50MB
$fileSizeLimitMB = $fileSizeLimitByte / 1000000;
$allowedFileTypes = array("jpeg","png","jpg");
$allowedFileTypesStr = implode(",", $allowedFileTypes);

// Directory for Upload Files
$fileUploadDirectory = "uploads/";

$target_file = $fileUploadDirectory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // Testing if the file is under the accepted file size, if $fileSizeLimit is enabled, otherwise it skips this code
    if($fileSizeLimit) {
        if($_FILES["fileToUpload"]["size"] > $fileSizeLimitByte) {
            $mainContent .= "Sorry, the max file size is ". $fileSizeLimitMB ."MB";
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
        }
    } else {
        if($_FILES["fileToUpload"]["size"] > $fileSizeLimitByte && $_FILES["fileToUpload"]["size"] < $maxFileSize) {
            $mainContent .= "Congrats! You have pulled off a DOS attack! Your file was way too big, pal! " ;
            $uploadOk = 0;
        } else if($_FILES["fileToUpload"]["size"] > $fileSizeLimitMB && $_FILES["fileToUpload"]["size"] > $maxFileSize ){
            $mainContent .= "Congrats! You pulled off a DOS attack, but it was way too big for our page! So you get some extra credit! ";
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
        }
    }
    // Testing if the file is one of the accepted file types, if $fileTypeRestriction is enabled, otherwise it skips this code
    if($fileTypeRestriction) {
        if(in_array($imageFileType, $allowedFileTypes) == false) {
            $mainContent .= "Sorry, the only accepted file types are ". $allowedFileTypesStr . " ";
            $uploadOk = 0;
        }
    }
    //Uploading Files as long as it fits in the requirements
    if ($uploadOk == 0) {
        $mainContent .= "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $mainContent .= "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded at " .$fileUploadDirectory;
        } else {
            $mainContent .= "Sorry, there was an error uploading your file.";
        }
    }
}
echo generatePage($mainContent, False);