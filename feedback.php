<?php
include "include/functions.php";
$banner = "<section id=\"hero-section\">";
$banner .= "<hgroup>";
$banner .= "<h2 id=\"hero-section-title\">Customer Feedback</h2>";
$banner .= "<p>We value your opinion!</p>";
$banner .= "</hgroup>";
$banner .= "<img src=\"img/review.jpg\" alt=\"\">";
$banner .= "</section>";
$mainContent .= "<section id=\"feedbackField\" class=\"single-column\">";
$mainContent .= "<form aria-labelledby=\"send-feedback-heading\" method=\"POST\", action='feedback.php' id='reviewSubmit'>";
$mainContent .= "<h2 id=\"send-feedback-heading\">We love to hear from our customers! Feel free to leave us some feedback!</h2>";
$mainContent .= "<input id=\"username-field\" type=\"hidden\" name=\"username\" required>";
$mainContent .= "<input id=\"date-field\" type=\"hidden\" name=\"date\" required>";
$mainContent .= "<textarea id=\"feedback\" name=\"feedback\" rows=\"5\" form=\"reviewSubmit\" autofocus required>";
$mainContent .= "</textarea><br>";
$mainContent .= "<button type=\"submit\">Send Feedback</button>";
$mainContent .= "</form>";
$mainContent .= "</section>";

#Enables vulnerabilities
$filterText = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_COOKIE["logged-in-user"];
    $user = userFromId((int)$userId);
    $date = date('F jS Y');
    if ($filterText == True) {
        $feedback = htmlspecialchars($_POST['feedback']);} 
    else {
        $feedback = $_POST['feedback'];}
    $reviewData = "<li id='reviewSubmissions'><b><u>" . $user['username'] . "</u></b><br>" . $feedback . "<br>"  . $date;
    file_put_contents("reviews/Reviews.txt", $reviewData, FILE_APPEND);}
if (is_file("reviews/Reviews.txt")){
    $reviews = "<div class=\"single-column\">" . file_get_contents("reviews/Reviews.txt") . "</div>";}
else{
    $reviews = " ";
}

$mainContent .= "</form>" . $reviews;
echo generatePage($banner . $mainContent);

