<?php
/*
    index.php
    Static page with some promotional content.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$mainContent .= createBanner("Northern Phish &amp; Loan", "The Ohio Valley's Leading Financial Institution", "/img/bank.webp");
$mainContent .= "<section class=\"cards\" aria-labelledby=\"cyber-promo-heading\">";
$mainContent .= "<h2 id=\"cyber-promo-heading\">Airtight Security.</h2>";
$mainContent .= "<img src=\"img/ad_1.webp\" alt=\"The DarkVault card: your funds, your security (completely in our hands).\">";
$mainContent .= "<img src=\"img/ad_2.webp\" alt=\"Open an account today (before someone else does it for you): Zero-fee transactions. Instant account Access. State-of-the-art security. Twenty-four seven customer support. Seamless transfers. Fraud protection.\">";
$mainContent .= "<img src=\"img/ad_3.webp\" alt=\"Twenty-four seven support: Our bots are always happy to (ignore) your fraud claims!\">";
$mainContent .= "<img src=\"img/ad_4.webp\" alt=\"Fraud protection: If someone steals your funds, we promise to (look concerned).\">";
$mainContent .= "</section>";
echo generatePage($mainContent);