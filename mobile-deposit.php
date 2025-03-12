<?php
include "include/functions.php";
$mainContent = "";;
$mainContent .= "<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\" aria-labelledby=\"mobile-check-deposit\" aria-describedby=\"mobile-deposit-description\">";
$mainContent .= "<h2 id=\"mobile-check-deposit\">Mobile Check deposit</h2>";
$mainContent .= "<p id=\"mobile-deposit-description\">Snap a picture of a check and mobile deposit it here. Once the image is processed and reviewed, the funds will be deposited into your account.</p>";
$mainContent .= "<label for=\"fileToUpload\" role=\"button\">Select Photo<input id=\"fileToUpload\" type=\"file\" name=\"fileToUpload\" required></label>";
$mainContent .= "<button type=\"submit\" name=\"submit\">Upload Image</button>";
$mainContent .= "</form>";
echo generatePage($mainContent);