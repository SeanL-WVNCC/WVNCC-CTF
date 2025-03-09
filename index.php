<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<section id=\"hero-section\" aria-labelledby=\"hero-section-title\">";
$mainContent .= "<hgroup>";
$mainContent .= "<h2 id=\"hero-section-title\">Northern Phish &amp; Loan</h2>";
$mainContent .= "<p>The Ohio Valley's Leading Financial Institution</p>";
$mainContent .= "</hgroup>";
$mainContent .= "<img src=\"img/bank.jpg\" alt=\"\">";
$mainContent .= "</section>";
$mainContent .= "<section class=\"cards\" aria-labelledby=\"cyber-promo-heading\">";
$mainContent .= "<h2 id=\"cyber-promo-heading\">Airtight Security.</h2>";
$mainContent .= "<img src=\"img/ad_1.png\" alt=\"The DarkVault card: your funds, your security (completely in our hands).\">";
$mainContent .= "<img src=\"img/ad_2.png\" alt=\"Open an account today (before someone else does it for you): Zero-fee transactions. Instant account Access. State-of-the-art security. Twenty-four seven customer support. Seamless transfers. Fraud protection.\">";
$mainContent .= "<img src=\"img/ad_3.png\" alt=\"Twenty-four seven support: Our bots are always happy to (ignore) your fraud claims!\">";
$mainContent .= "<img src=\"img/ad_4.png\" alt=\"Fraud protection: If someone steals your funds, we promise to (look concerned).\">";
$mainContent .= "</section>";
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