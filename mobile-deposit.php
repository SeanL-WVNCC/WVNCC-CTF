<?php
include "include/functions.php";
$mainContent = "";;
$mainContent .= "<form aria-label=\"Mobile check deposit\" action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">";
$mainContent .= "Please Upload Photo of check: ";
$mainContent .= "<p>Upload checks for deposit here. Only image files can be submitted.</p>";
$mainContent .= "<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">";
$mainContent .= "<input type=\"submit\" value=\"Upload Image\" name=\"submit\">";
$mainContent .= "</form>";
echo generatePage($mainContent);