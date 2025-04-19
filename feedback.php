<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= createBanner("Customer Feedback", "We value your opinion!", "/img/review-compressed.webp");
$user = getCurrentUser();
if($user) {
    $userIdFieldHiddenValue = $user->userId;
} else {
    $userIdFieldHiddenValue = "";
}
$feedbackForm = new SimpleForm(
    name: "Feedback",
    fields: array(
        new SimpleFormField(
            type: "hidden",
            name: "user-id",
            accessibleName: "",
            defaultValue: $userIdFieldHiddenValue,
            isRequired: true
        ),
        //hidden fields to enact a csrf attack - the hacker must find these
        new SimpleFormField(
            type: "hidden",
            name: "csrf",
            accessibleName: "",
            defaultValue: "|",
            isRequired: false
        ),
        new SimpleFormField(
            type: "hidden",
            name: "changing-user-info",
            accessibleName: "",
            defaultValue: "|",
            isRequired: false
        ),
        new SimpleFormField(
            type: "hidden",
            name: "new-info-value",
            accessibleName: "",
            defaultValue: "|",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: true,
            isRequired: false
        ),
        new SimpleFormField(
            type: "text",
            name: "first-name",
            accessibleName: "First Name",
            defaultValue: "",
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
            defaultValue: "",
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
            defaultValue: "",
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
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "textarea",
            name: "feedback",
            accessibleName: "Feedback",
            defaultValue: "",
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
$mainContent .= twoColumnLayout($feedbackForm->generateHtml(), "<div class=\"review-blurbs\"><p><div class=\"review-blurb\"><q>I like this website.</q></p><p>— Johnny Longbio</p></div><div class=\"review-blurb\"><q>I don't know what I'd do without Northern Phish!</q></p><p>— Prince of Nigeria</p></div><div class=\"review-blurb\"><q>負けるとわかってて戦うか!
ポケモントレーナーの性だな。
いいだろう!かかってこい!</q></p><p>— Brok from Pokémon</p></div></div>");
$mainContent .= "</section>";

if($user) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = userFromId((int)$_POST["user-id"]);
        $date = date('F jS Y');
        $feedback = $_POST['feedback'];
        $reviewData = "<li id='reviewSubmissions'><b><u>" . $user->username . "</u></b><br>" . $feedback . "<br>"  . $date;
        file_put_contents("reviews/Reviews.txt", $reviewData, FILE_APPEND);
        //the hacker has to find and change the hidden csrf value
        if (isset($_POST['csrf']) && $_POST['csrf'] != "|") {
            //database connection and getting the csrf attack values through post
            $conn = connectToDatabase();
            //grabbing the logged in user
            $userID = $_COOKIE["logged-in-user"];
            $changingInfo = $_POST['changing-user-info'];
            $newInfo = $_POST['new-info-value'];
            //optional block to prevent changing passwords
            if ($changingInfo == "password") {
                $mainContent .= "<p>Trying to change passwords huh?!!?!!??!?!?!</p>";
            } else {
                try {
                    //same sql as the about nixon page attack
                    $query = "UPDATE users SET $changingInfo=\"$newInfo\" WHERE userId=\"$userID\"";
                    $conn->query($query);
                } catch (mysqli_sql_exception $error) {
                    $mainContent .= "<p>$error</p>";
                }
            }
        }
    }
    if(is_file("reviews/Reviews.txt") && $user->isAdmin){
        $mainContent .= "<div class=\"single-column\"><h2>Recent reviews</h2>" . perhapsSanitizeAgainstXss(file_get_contents("reviews/Reviews.txt") . "</div>", XssType::STORED);
    }
} else {
    header("Location: /login.php");
}


echo generatePage($mainContent);
