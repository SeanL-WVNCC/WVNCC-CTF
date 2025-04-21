<?php
include "include/functions.php";
$mainContent = "";
$leftColumn = "";
$rightColumn = "";
$leftColumn2 = "";
$rightColumn2 = "";
$leftColumn3 = "";
$rightColumn3 = "";

$mainContent .= createBanner("Locations", "", "/img/wheeling-campus-2.png");
$leftColumn .= "<h3 id=\"locations-info\">Weirton Branch</h3>";
$leftColumn .= "<img class=\"locations-imgs\" src=\"img/weirton-campus.jpg\">";
$rightColumn .= "<h3 id=\"locations-info\">Information</h3>";
$rightColumn .= "<p>Address: 4321 Weirton Street</p>";
$rightColumn .= "<p>Weirton, WV, 26062</p>";
$rightColumn .= "<p>Contact: (304) 444-4444</p>";
$rightColumn .= "<p>Hours: Mon-Fri 6am to 9pm</p>";
$mainContent .= twoColumnLayout(presentationalWrapper($leftColumn), presentationalWrapper($rightColumn));
$leftColumn2 .= "<h3 id=\"locations-info\">Wheeling Branch</h3>";
$leftColumn2 .= "<img class=\"locations-imgs\" src=\"img/wheeling-campus.jpg\">";
$rightColumn2 .= "<h3 id=\"locations-info\">Information</h3>";
$rightColumn2 .= "<p>Address: 1234 Wheeling Street</p>";
$rightColumn2 .= "<p>Wheeling, WV, 26003</p>";
$rightColumn2 .= "<p>Contact: (304) 333-3333</p>";
$rightColumn2 .= "<p>Hours: Mon-Fri 8am to 8pm</p>";
$mainContent .= twoColumnLayout(presentationalWrapper($leftColumn2), presentationalWrapper($rightColumn2));
$leftColumn3 .= "<h3 id=\"locations-info\">New Martinsville Branch</h3>";
$leftColumn3 .= "<img class=\"locations-imgs\" src=\"img/martinsville-campus.jpg\">";
$rightColumn3 .= "<h3 id=\"locations-info\">Information</h3>";
$rightColumn3 .= "<p>Address: 5678 Martinsville Street</p>";
$rightColumn3 .= "<p>New Martinsville, WV, 26155</p>";
$rightColumn3 .= "<p>Contact: (304) 444-4444</p>";
$rightColumn3 .= "<p>Hours: Mon-Fri 7am to 11pm</p>";
$mainContent .= twoColumnLayout(presentationalWrapper($leftColumn3), presentationalWrapper($rightColumn3));

echo generatePage($mainContent);