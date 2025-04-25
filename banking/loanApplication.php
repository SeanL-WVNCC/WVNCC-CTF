<?php 
include "/var/www/html/include/functions.php";
session_start();$user = getCurrentUser();
if($user) {
    $userIdFieldHiddenValue = $user->userId;
} else {
    $userIdFieldHiddenValue = "";
} 
//NEED TO ADD WHERE THE FORM SUBMITS TO. WANT TO ASK VIKRAM FIRST FOR PREFERENCE
$loanApplicationForm = new SimpleForm(
    name: "Loan Application",
    fields: array(
        new SimpleFormField(
            type: "hidden",
            name: "user-id",
            accessibleName: "",
            defaultValue: $userIdFieldHiddenValue,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "fullName",
            accessibleName: "Full Name",
            isRequired: true
        ),
        new SimpleFormField(
            type: "number",
            name: "ssNumber",
            accessibleName: "Social Security Number",
            defaultValue: "000-000-0000",
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "accountNumber",
            accessibleName: "Account Number",
            isRequired: true
        ),
        new SimpleFormField(
            type: "number",
            name: "annualIncome",
            accessibleName: "Annual Income",
            isRequired: true
        ),
    new SimpleFormField(
        type: "number",
        name: "monthlyHousing",
        accessibleName: "Monthly Housing Expense",
        isRequired: true
    ),
    ),
    instructions: "",
    method: "POST",
    action: "/loanApplication.php",
    submitButtonName: "Submit Application"
);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = userFromId((int)$_POST["user-id"]);
    $newApplication = fopen("loan_applications/" . $user->username . "LoanApplication.txt","w");
    $userData = ("Full Name(" . $_POST['fullName'] . ") Social Security(" . $_POST['ssNumber'] . ") ");
    $financialData = ("Account Number(" . $_POST['accountNumber'] . ") Annual Income(" . $_POST['annualIncome'] . ") Monthly Housing Payment(" . $_POST['monthlyHousing'] . ")");
    fwrite($newApplication, $userData);
    fwrite($newApplication, $financialData);
    fclose($newApplication);
    $loanApplicationForm->instructions .= "<p>Your loan application has been successfully submitted at loan_applications/</p>";
}
$mainContent = "";
$mainContent .= $loanApplicationForm->generateHtml();
echo generatePage($mainContent);