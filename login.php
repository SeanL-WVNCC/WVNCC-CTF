<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
            <?php
                include "include/vulnconfig.php";
                $output = "";
                $output .= "<main id=\"main\">";
                $output .= "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"login.php\">";
                $output .= "<h2 id=\"login-heading\">Login</h2>";
                $output .= "<label for=\"username-field\">Username</label>";
                $output .= "<input id=\"username-field\" type=\"text\" name=\"username\" autofocus required>";
                $output .= "<label for=\"password-field\">Password</label>";
                $output .= "<input id=\"password-field\" type=\"password\" name=\"password\" required>";
                $output .= "<button type=\"submit\">Login</button>";
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    $conn = mysqli_connect("db", "root", "hackme", "breakTheBank");
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $result = $conn->query("SELECT * FROM users WHERE username=\"$username\"");
                    if($user = $result->fetch_assoc()) {
                        if($password == $user["password"]) {
                            $output .= "Username and password were correct.";
                        } else {
                            $output .= "Password incorrect.";
                        }
                    } else {
                        $output .= "Username \"$username\" not found.";
                    }
                    #setcookie("is-logged-in", "true", path:"/");
                }
                $output .= "</form>";
                $output .= "</main>";
                echo $output;
            ?>
            <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>
