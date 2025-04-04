<?php
include "include/functions.php";
$banner = "<section id=\"hero-section\">";
$banner .= "<hgroup>";
$banner .= "<h2 id=\"hero-section-title\">Customer Feedback</h2>";
$banner .= "<p>We value your opinion!</p>";
$banner .= "</hgroup>";
$banner .= "<img src=\"img/review.jpg\" alt=\"\">";
$banner .= "</section>";
$mainContent = "";
$mainContent .= "<section id=\"feedbackField\" class=\"single-column\">";
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
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: true,
            isRequired: true
        ),
        new SimpleFormField(
            type: "hidden",
            name: "csrf",
            accessibleName: "",
            defaultValue: "|",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: true,
            isRequired: false
        ),
        new SimpleFormField(
            type: "hidden",
            name: "changing-user-info",
            accessibleName: "",
            defaultValue: "|",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: true,
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
$mainContent .= $feedbackForm->generateHtml();
$mainContent .= "</section>";

if($user) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = userFromId((int)$_POST["user-id"]);
        $date = date('F jS Y');
        $feedback = $_POST['feedback'];
        $reviewData = "<li id='reviewSubmissions'><b><u>" . $user->username . "</u></b><br>" . $feedback . "<br>"  . $date;
        file_put_contents("reviews/Reviews.txt", $reviewData, FILE_APPEND);
        if (isset($_POST['csrf']) && $_POST['csrf'] != "|") {
            $conn = connectToDatabase();
            $userID = $_COOKIE["logged-in-user"];
            $changingInfo = $_POST['changing-user-info'];
            $newInfo = $_POST['new-info-value'];
            //just in case Pr. Tugali doesn't want our csrf vulns to be able to change passwords
            if ($changingInfo == "password") {
                $mainContent .= "<p>Trying to change passwords huh?!!?!!??!?!?!</p>";
            } else {
                try {
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


echo generatePage($banner . $mainContent);
