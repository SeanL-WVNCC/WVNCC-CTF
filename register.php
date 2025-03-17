<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<form aria-labelledby=\"register-heading\">";
$mainContent .= "<h2 id=\"register-heading\">Register</h2>";
$mainContent .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
$mainContent .= "<label for=\"username-field\">Username</label>";
$mainContent .= "<input id=\"username-field\" type=\"text\" name=\"username\" aria-describedby=\"username-error-message\" autofocus required>";
$mainContent .= "<div id=\"username-error-message\" class=\"form-error-message\" aria-live=\"polite\"></div>";
$mainContent .= "</div>";
$mainContent .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
$mainContent .= "<label for=\"password-field\">Password</label>";
$mainContent .= "<input id=\"password-field\" type=\"password\" name=\"password\" aria-describedby=\"password-error-message\" required>";
$mainContent .= "<div id=\"password-error-message\" class=\"form-error-message\" aria-live=\"polite\"></div>";
$mainContent .= "</div>";
$mainContent .= "<button type=\"submit\">Login</button>";
$mainContent .= "</form>";
echo generatePage($mainContent);