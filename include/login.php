<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    setcookie("is-logged-in", "true", path:"/");
} else {
    echo "<main id=\"main\">";
    echo "<form aria-labelledby=\"login-heading\" method=\"POST\" action=\"include/login.php\">";
    echo "<h2 id=\"login-heading\">Login</h2>";
    echo "<label for=\"username-field\">Username</label>";
    echo "<input id=\"username-field\" type=\"text\" name=\"username\" autofocus required>";
    echo "<label for=\"password-field\">Password</label>";
    echo "<input id=\"password-field\" type=\"password\" name=\"password\" required>";
    echo "<button type=\"submit\">Login</button>";
    echo "</form>";
    echo "</main>";
}
