<?php
include "include/functions.php";
//setting up the top of the page, the banner
$banner = "<section id=\"hero-section\">";
$banner .= "<hgroup>";
$banner .= "<h2 id=\"hero-section-title\">Administration</h2>";
$banner .= "</hgroup>";
$banner .= "<img src=\"img/admin.jpg\" alt=\"Image of a person working at a desk with a laptop and various papers and items.\">";
$banner .= "</section>";
//init variables
$mainContent = "";
$table = "";
//grabs the currently logged in user and their information from the database
$user = getCurrentUser();
if ($user) {
    //gets the boolean from the "isAdmin" field
    $adminCheck = $user->isAdmin;
    //the rest of the page only appears if that = true
    if ($adminCheck == true) {
        //database connection since it's needed for essentially all admin functions
        $conn = connectToDatabase();
        //admin function form
        $mainContent .= "<form id=\"admin-menu\" action=\"admin.php\" method=\"POST\">";
        $mainContent .= "<button name=\"display-users\">Users</button>";
        $mainContent .= "<button name=\"change-pass\">Edit User Password</button>";
        $mainContent .= "<button name=\"add-admins\">Add Administrators</button>";
        $mainContent .= "<button name=\"admin-funct\">Placeholder</button>";
        $mainContent .= "</form>";
        //once one of those buttons is pressed and the form gets submitted the admin page truly comes alive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Display Users
            //queries the database and displays all users and all of their info in generated tables
            //pin number check and possible password hashing to be added
            if (isset($_POST["display-users"])) {
                $query = "SELECT * FROM users";
                $users = $conn->query($query);
                while($row = $users->fetch_assoc()) {
                    $table = "<table>";
                    $table .= "<tbody>";
                    //optional id number inclusion
                    //$table .= "<tr><th>User ID</th></tr><tr><td>" . $row["userId"] . "</td></tr>";
                    $table .= "<tr><th>Username</th></tr><tr><td>" . $row["username"] . "</td></tr>";
                    $table .= "<tr><th>Password</th></tr><tr><td>" . $row["password"] . "</td></tr>";
                    $table .= "<tr><th>First Name</th></tr><tr><td>" . $row["firstName"] . "</td></tr>";
                    $table .= "<tr><th>Last Name</th></tr><tr><td>" . $row["lastName"] . "</td></tr>";
                    // <wbr> element to prevent side scrolling on mobile, I knew I'd use it one day
                    $table .= "<tr><th>Email</th></tr><tr><td><a href=\"mailto:".$row["email"]."\">" . str_replace("@",  "@<wbr>", $row["email"]) . "</a></td></tr>";
                    $table .= "<tr><th>Admin Status</th></tr><tr><td>" . $row["isAdmin"] . "</td></tr>";
                    $table .= "</tbody>";
                    $table .= "</table>";
                    $mainContent .= $table;
                }
            //Change Password
            //generates a change password form that lets the admin input a username and a new password for that chosen user
            } elseif (isset($_POST["change-pass"])) {
                $passwordChangeFormForm = new SimpleForm(
                    name: "Change Password",
                    fields: array(
                        //hidden field so the actual password change triggers & is done
                        new SimpleFormField(
                            type: "hidden",
                            name: "adminChangePass",
                            accessibleName: "",
                            defaultValue: "yes",
                            options: array(),
                            errorMessage: "",
                            validationIcon: null,
                            autofocus: false,
                            isRequired: true
                        ),
                        new SimpleFormField(
                            type: "username",
                            name: "username",
                            accessibleName: "Username",
                            defaultValue: "",
                            options: array(),
                            errorMessage: "",
                            validationIcon: null,
                            autofocus: false,
                            isRequired: true
                        ),
                        new SimpleFormField(
                            type: "password",
                            name: "password",
                            accessibleName: "New Password",
                            defaultValue: "",
                            options: array(),
                            errorMessage: "",
                            validationIcon: null,
                            autofocus: false,
                            isRequired: true
                        ),
                    ),
                    instructions: "",
                    method: "POST",
                    action: "admin.php",
                    submitButtonName: "Change Password"
                );
                $mainContent .= $passwordChangeFormForm->generateHtml();
            //queries the database to change the password of the chosen user from the change password form
            } elseif (isset($_POST["adminChangePass"])) {
                $newPass = $_POST["password"];
                $username = $_POST["username"];
                try {
                    $query = "UPDATE users SET password=\"$newPass\" WHERE username=\"$username\"";
                    $conn->query($query);
                } catch (mysqli_sql_exception $error) {
                    $mainContent .= "<p>$error</p>";
                }
            }
        }
    //both of these index.php location headers are so users are sent back if they try to get to the admin page without being an admin (or without being logged in)
    } else {
        header("Location: /index.php");
    }
} else {
    header("Location: /index.php");
}

echo generatePage($banner . $mainContent);
