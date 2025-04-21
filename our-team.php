<?php
/*
    our-team.php
    Static page with information about our staff.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$banner = createBanner("Our Team", "", "/img/bank.webp");
$mainContent .= "<table id=\"meet-our-team\">";
$mainContent .= "<tbody>";
$mainContent .= createOurTeamEntry("Angela Ackermann", "Director of Threatening SLAPP Lawsuits", "304-555-5555", 301, "angela_ackermann@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= createOurTeamEntry("Grant Kent", "Director of Incompliance", "304-555-1234", 501, "grant_kent@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= createOurTeamEntry("Josephine Poulin", "Vice President of Elaborate Documentation and Auditing", "304-555-5555", 505, "josephine_poulin@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= createOurTeamEntry("Sean Lauritzen II", "Associate Director of Operational Strategy Management", "304-555-5555", 302, "sean_lauritzen@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= createOurTeamEntry("Kevin Hoge", "Chief Operator of Perimeter Doorknobs", "304-555-5555", 304, "kevin_hoge@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= createOurTeamEntry("Wyatt McNeil", "Chancellor of High Interest Loans", "304-555-5555", 117, "wyatt_mcneil@northernphish.com", "/img/dick_nixon.jpg");
$mainContent .= "</tbody>";
$mainContent .= "</table>";
// Removed the contact form for now; if it is not obsolesced
// by the feedback form it can be returned from the git history for later use
echo generatePage($banner . $mainContent);
