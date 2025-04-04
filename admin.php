<?php
include "include/functions.php";
$banner = "<section id=\"hero-section\">";
$banner .= "<hgroup>";
$banner .= "<h2 id=\"hero-section-title\">Administration</h2>";
$banner .= "</hgroup>";
$banner .= "<img src=\"img/admin.jpg\" alt=\"Image of a person working at a desk with a laptop and various papers and items.\">";
$banner .= "</section>";
$mainContent = "";
$table = "";
$user = getCurrentUser();
if ($user) {
    $adminCheck = $user->isAdmin;
    if ($adminCheck == true) {
        $conn = connectToDatabase();
        $mainContent .= "<form action=\"admin.php\" method=\"POST\">";
        $mainContent .= "<button name=\"display-users\">Users</button>";
        //hacky solution to quickly push these buttons apart just so it's easier on the eyes
        $mainContent .= "     ";
        $mainContent .= "<button name=\"change-pass\">Edit User Password</button>";
        $mainContent .= "     ";
        $mainContent .= "<button name=\"add-admins\">Add Administrators</button>";
        $mainContent .= "     ";
        $mainContent .= "<button name=\"admin-funct\">Placeholder</button>";
        $mainContent .= "</form>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["display-users"])) {
                $query = "SELECT * FROM users";
                $users = $conn->query($query);
                $table .= "<table>";
                $table .= "<tbody>";
                while($row = $users->fetch_assoc()) {
                    //$table .= "<tr><th>User ID</th></tr><tr><td>" . $row["username"] . "</td></tr>";
                    $table .= "<tr><th>Username</th></tr><tr><td>" . $row["username"] . "</td></tr>";
                    $table .= "<tr><th>Password</th></tr><tr><td>" . $row["password"] . "</td></tr>";
                    $table .= "<tr><th>First Name</th></tr><tr><td>" . $row["firstName"] . "</td></tr>";
                    $table .= "<tr><th>Last Name</th></tr><tr><td>" . $row["lastName"] . "</td></tr>";
                    $table .= "<tr><th>Email</th></tr><tr><td>" . $row["email"] . "</td></tr>";
                    $table .= "<tr><th>Admin Status</th></tr><tr><td>" . $row["isAdmin"] . "</td></tr>";
                    $table .= "<tr><th></th></tr><tr><td><button>Contact</button></td></tr>";
                }
                $table .= "</tbody>";
                $table .= "</table>";
                $mainContent .= $table;
            } elseif (isset($_POST["change-pass"])) {
                $passwordChangeFormForm = new SimpleForm(
                    name: "Change Password",
                    fields: array(
                        new SimpleFormField(
                            type: "hidden",
                            name: "adminAction",
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
            } elseif (isset($_POST["adminAction"])) {
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
    } else {
        header("Location: /index.php");
    }
} else {
    header("Location: /index.php");
}

echo generatePage($banner . $mainContent);