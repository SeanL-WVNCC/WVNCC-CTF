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
echo generatePage($mainContent, false);

/*
<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
             <?php
                $conn = mysqli_connect("db", "root", "hackme");
                include "include/vulnconfig.php";
                $includeDirectory = "/var/www/html";
                $pageToInclude = $_GET["page"];
                if($isVulnerableToPathTraversal) {
                    // If path traversal is possible, divulge in comment
                    echo "<!-- INSECURE: this code is vulnerable to a path traversal attack. -->";
                }
                if(file_exists($pageToInclude))  {
                    $pageToInclude = realpath($pageToInclude);
                    // Make sure the included folder is in the "includes" folder... sometimes
                    if(str_starts_with($pageToInclude, $includeDirectory) or $isVulnerableToPathTraversal) {
                        include $pageToInclude;
                    }
                } else {
                    echo "<main></main>";
                }
             ?>
             <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>*/