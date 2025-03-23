<?php 
include "include/functions.php";
session_start();
$mainContent = "";
$mainContent .= "<h2 id=\"send-feedback-heading\">Transfer Funds</h2>";
$mainContent .= "<form action=\"transfer.php\" method=\"POST\"";
$mainContent .= "<label for=\"from\">Select Account To Transfer From:</label><br>";
$mainContent .= "<select name=\"from-ac\" id=\"from\">";
$mainContent .= "<option value=\"from-savings\">Savings</option>";
$mainContent .= "<option value=\"from-checking\">Checking</option>";
$mainContent .= "</select><br><br>";
$mainContent .= "<label for=\"to\">Select Account To Send Funds:</label><br>";
$mainContent .= "<select name=\"to-ac\" id=\"to\">";
$mainContent .= "<option value=\"to-savings\">Savings</option>";
$mainContent .= "<option value=\"to-checking\">Checking</option>";
$mainContent .= "</select><br><br>";
$mainContent .= "<label for\"amount\">Amount:</label><br>";
$mainContent .= "<input id=\"amount\" type=\"text\" name=\"amount\" required><br><br>";
$mainContent .= "<button type=\"submit\"/>Transfer</button>";
$mainContent .= "</form>";
echo generatePage($mainContent);