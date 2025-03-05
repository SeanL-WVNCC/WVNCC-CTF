<?php
include "include/functions.php";
$mainContent = "";
$mainContent .= "<section aria-labeledby=\"northern-phish-history\">";
$mainContent .= "<h2 id=\"northern-phish-history\">Our story</h2>";
$mainContent .= "<p>Northern Phish &amp; Loan is a bank that has been commited to serving the Ohio Valley since 1953.</p>";
$mainContent .= "<h2>Meet Our Team!</h2>";
$mainContent .= "<table>";
$mainContent .= "<tbody>";
$mainContent .= "<tr>";
$mainContent .= "<td>Angela Ackermann</td>";
$mainContent .= "<td>Director of Threatening SLAPP Lawsuits</td>";
$mainContent .= "</tr>";
$mainContent .= "</tbody>";
$mainContent .= "<tr>";
$mainContent .= "<td>Grant Kent</td>";
$mainContent .= "<td>Director of Incompliance</td>";
$mainContent .= "</tr>";
$mainContent .= "<tr>";
$mainContent .= "<td>Josephine Poulin</td>";
$mainContent .= "<td>Vice President of Elaborate Documentation and Auditing</td>";
$mainContent .= "</tr>";
$mainContent .= "<tr>";
$mainContent .= "<td>Sean Lauritzen II</td>";
$mainContent .= "<td>Associate Director of Operational Strategy Management</td>";
$mainContent .= "</tr>";
$mainContent .= "<tr>";
$mainContent .= "<td>Kevin Hoge</td>";
$mainContent .= "<td>Perimeter Doorknobs</td>";
$mainContent .= "</tr>";
$mainContent .= "<tr>";
$mainContent .= "<td>Wyatt McNeil</td>";
$mainContent .= "<td>ROLE NEEDED</td>";
$mainContent .= "</tr>";
$mainContent .= "</tbody>";
$mainContent .= "</table>";
$mainContent .= "<h2>Contact</h2>";
$mainContent .= "<p><a href=\"tel:304-555-1234\">Call Us: 304-555-1234</a></p>";
$mainContent .= "<p>Our Address: 1234 Bank Street, Semaphore, WV</p>";
$mainContent .= "<p><a href=\"mailto:northernphish@email.com\">Email us at: northernphish@email.com</a></p>";
$mainContent .= "</section>";
echo generatePage($mainContent, False);