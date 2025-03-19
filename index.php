<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<section id=\"hero-section\" aria-labelledby=\"hero-section-title\">";
$mainContent .= "<hgroup>";
$mainContent .= "<h2 id=\"hero-section-title\">Northern Phish &amp; Loan</h2>";
$mainContent .= "<p>The Ohio Valley's Leading Financial Institution</p>";
$mainContent .= "</hgroup>";
$mainContent .= "<img src=\"img/bank.webp\" alt=\"\">";
$mainContent .= "</section>";
$mainContent .= "<section class=\"cards\" aria-labelledby=\"cyber-promo-heading\">";
$mainContent .= "<h2 id=\"cyber-promo-heading\">Airtight Security.</h2>";
$mainContent .= "<img src=\"img/ad_1.webp\" alt=\"The DarkVault card: your funds, your security (completely in our hands).\">";
$mainContent .= "<img src=\"img/ad_2.webp\" alt=\"Open an account today (before someone else does it for you): Zero-fee transactions. Instant account Access. State-of-the-art security. Twenty-four seven customer support. Seamless transfers. Fraud protection.\">";
$mainContent .= "<img src=\"img/ad_3.webp\" alt=\"Twenty-four seven support: Our bots are always happy to (ignore) your fraud claims!\">";
$mainContent .= "<img src=\"img/ad_4.webp\" alt=\"Fraud protection: If someone steals your funds, we promise to (look concerned).\">";
$mainContent .= "</section>";
echo generatePage($mainContent);