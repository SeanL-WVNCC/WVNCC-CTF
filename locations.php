<?php
/*
    about.php
    Static page with information about the company.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$mainContent .= createBanner("Local Branches", "Banking for the Ohio Valley", "/img/ribbon.jpg");
$wheeling = "<h2>Wheeling</h2>";
$wheeling .= "<img src=\"/img/bank.webp\" alt=\"The Wheeling branch\">";
$wheeling .= "<p>Our Wheeling location is our oldest branch and houses the Northern Phish &amp; Loan headquarters. The historic building was once a railway station for the Baltimore and Ohio Railroad.</p>";
$wheeling .= "<address>1704 Market Street<br>Wheeling, WV 26003</address>";
$weirton = "<h2>Weirton</h2>";
$weirton .= "<img src=\"/img/weirton-location.jpg\" alt=\"The Weirton branch\">";
$weirton .= "<p>Our Weirton branch was built in 1985 to accommodate increased business activity from the Italian mafia. It serves the greater Weirton/Steubenville area.</p>";
$weirton .= "<address>150 Park Avenue<br>Weirton, WV 26062</address>";
$newMartinsville = "<h2>New Martinsville</h2>";
$newMartinsville .= "<img src=\"/img/nm-location.jpg\" alt=\"The New Martinsville branch\">";
$newMartinsville .= "<p>New Martinsville became latest to join the Northern Phish &amp; Loan family in October 2019. It was acquired from West Virginia Northern Community College, presumably because they all attend via Zoom anyway.</p>";
$newMartinsville .= "<address>141 Main Street<br>New Martinsville, WV 26155</address>";
$mainContent .= presentationalWrapper(threeColumnLayout(presentationalWrapper($wheeling), presentationalWrapper($weirton), presentationalWrapper($newMartinsville)));

echo generatePage($mainContent);
