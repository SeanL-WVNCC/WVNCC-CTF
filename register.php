<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<form aria-labelledby=\"register-heading\">";
$mainContent .= "<h2 id=\"register-heading\">Register</h2>";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" type=\"text\" name=\"username\" autofocus required>";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" type=\"password\" name=\"password\" required>";
$mainContent .= "<button type=\"submit\">Login</button>";
$mainContent .= "</form>";
echo generatePage($mainContent);