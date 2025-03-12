<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<form aria-labelledby=\"send-feedback-heading\" method=\"GET\", action=\"feedback.php\">";
$mainContent .= "<h2 id=\"send-feedback-heading\">Send Feedback</h2>";
$mainContent .= "<!-- Hidden fields, please do not tamper -->";
$mainContent .= "<input id=\"username-field\" type=\"hidden\" name=\"username\" required>";
$mainContent .= "<input id=\"date-field\" type=\"hidden\" name=\"date\" required>";
$mainContent .= "<label for=\"feedback\">Feedback</label><br>";
$mainContent .= "<input id=\"feedback\" type=\"text\" name=\"feedback\" autofocus required>";
$mainContent .= "<button type=\"submit\">Send Feedback</button>";
// No need for a clear fields input
$mainContent .= "</form>";
echo generatePage($mainContent);