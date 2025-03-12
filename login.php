<?php
session_start();
include "include/functions.php";
$mainContent = "";
include "include/vulnconfig.php";
$mainContent .= "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"login.php\">";
$mainContent .= "<h2 id=\"login-heading\">Login</h2>";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" type=\"text\" name=\"username\" autofocus required>";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" type=\"password\" name=\"password\" required>";
$mainContent .= "<button type=\"submit\">Login</button>";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $conn = mysqli_connect("db", "root", "hackme", "breakTheBank");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = "SELECT * FROM users WHERE username=\"$username\"";
        $result = $conn->query($query);
        if($user = $result->fetch_assoc()) {
            if($password == $user["password"]) {
                setcookie("is-logged-in", "true");
                $_SESSION["logged-in-user"] = $username;
                header("Location: /");
                $mainContent .= "Username and password were correct.";
            } else {
                $mainContent .= "Password incorrect.";
            }
        } else {
            $mainContent .= "Username \"$username\" not found.";
        }
    } catch (mysqli_sql_exception $error) {
        $mainContent .= "<div>Invalid SQL: <code>SELECT * FROM users WHERE username=\"<u>$username\"</u></code></div>";
        if(str_starts_with($username, '"')) {
            $mainContent .= "<div>Content following quote appears to be invalid.</div>";
        }
    }
}
$mainContent .= "</form>";
echo generatePage($mainContent);
