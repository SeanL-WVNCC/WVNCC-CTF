<?php
/*
    feedback.php
    TODO: This page should submit feedback as described by
    Grant's feature request.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$mainContent .= "<form aria-labelledby=\"send-feedback-heading\" method=\"GET\", action=\"feedback.php\">";
$mainContent .= "<h2 id=\"send-feedback-heading\">Send Feedback</h2>";
// Source code hint
$mainContent .= "<!-- Hidden fields, please do not tamper -->";
$mainContent .= "<input id=\"username-field\" type=\"hidden\" name=\"username\" required>";
$mainContent .= "<input id=\"date-field\" type=\"hidden\" name=\"date\" required>";
$mainContent .= "<label for=\"feedback\">Feedback</label><br>";
$mainContent .= "<input id=\"feedback\" type=\"text\" name=\"feedback\" autofocus required>";
$mainContent .= "<button type=\"submit\">Send Feedback</button>";
$mainContent .= "</form>";
echo generatePage($mainContent);