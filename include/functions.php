<?php
function generatePage(string $mainContent, bool $useSideContent): string {

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    $result = "<!DOCTYPE html><html lang=\"en\">";
    $result .= "<head>";
    $result .= "<meta charset=\"utf-8\">";
    $result .= "<meta name=\"author\" content=\"Everyone's names will go here\">";
    $result .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/header.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/secondary-nav.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/main.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/featured.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/footer.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/home.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/media-queries.css\">";
    $result .= "<link rel=\"icon\" type=\"img/x-icon\" href=\"./img/logo.png\">";
    if($useSideContent) {
        $result .= "<style>main {padding: 1rem;}</style>";
    }
    $result .= "<title>Northern Phish &amp; Loan</title>";
    $result .= "</head>";
    $result .= "<body>";
    $result .= "<header>";
    $result .= "<a id=\"skip-link\" href=\"#main\">Skip to content</a>";
    $result .= "<h1><img src=\"./img/logo.png\" alt=\"Northern Phish and Loan\"></h1> <!-- This was a link, removed to reduce unnecessary tab stops -->";
    $result .= "<nav id=\"primary-navigation\" aria-label=\"Site Navigation\">";
    $result .= "<ul>";
    $result .= "<li><a href=\"index.php\">Home</a></li>";
    if(isset($_COOKIE["is-logged-in"])) {
        $result .= "<li><a href=\"new-account.php\">Open account</a></li>";
        $result .= "<li><a href=\"transfer.php\">Funds transfer</a></li>";
        $result .= "<li><a href=\"profile.php\">Profile</a></li>";
        $result .= "<li><a href=\"mobile-deposit.php\">Mobile deposit</a></li>";
        $result .= "<li><a href=\"dashboard.php\">Dashboard</a></li>";
        $result .= "<li><a href=\"feedback.php\">Feedback</a></li>";
    } else {
        $result .= "<li><a href=\"login.php\">Login</a></li>";
        $result .= "<li><a href=\"register.php\">Register</a></li>";
    }
    $result .= "<li><a href=\"about.php\">About Us</a></li>";
    $result .= "</ul>";
    $result .= "</nav>";
    $result .= "<form role=\"search\" method=\"GET\" action=\"search.php\">";
    $result .= "<input id=\"query-field\" type=\"search\" name=\"query\" required aria-labelledby=\"search-button\" title=\"Search site by keyword\" placeholder=\"Search keywords\">";
    $result .= "<button id=\"search-button\" type=\"submit\" aria-label=\"Search\"><img src=\"img/search-icon.svg\" alt=\"\"></button>";
    $result .= "</form>";
    $result .= "</header>";
    if($useSideContent) {
        $result .= "<div>";
        $result .= "<nav id=\"secondary-navigation\" aria-label=\"Our Accounts\">";
        $result .= "<ul>";
        $result .= "<li><a href=\"promotions.php?page=include/checking.php\">Checking</a></li>";
        $result .= "<li><a href=\"promotions.php?page=include/savings.php\">Savings &amp; CDs</a></li>";
        $result .= "<li><a href=\"promotions.php?page=include/credit-cards.php\">Credit Cards</a></li>";
        $result .= "<li><a href=\"promotions.php?page=include/personal.php\">Personal</a></li>";
        $result .= "<li><a href=\"promotions.php?page=include/business.php\">Business</a></li>";
        $result .= "<li><a href=\"promotions.php?page=include/financial-education.php\">Financial Education</a></li>";
        $result .= "</ul>";
        $result .= "</nav>";
    }
    $result .= "<main>$mainContent</main>";
    if($useSideContent) {
        $result .= "<section class=\"offers\" role=\"complementary\" aria-label=\"Featured Offers\">";
        $result .= "<div>";
        $result .= "<h2>Another checking offer</h2>";
        $result .= "<p>Here is some placeholder text for another account offer.</p>";
        $result .= "</div>";
        $result .= "<div>";
        $result .= "<h2>Student account offer</h2>";
        $result .= "<p>Check our our special account just for students!</p>";
        $result .= "</div>";
        $result .= "<div>";
        $result .= "<h2>Mobile app</h2>";
        $result .= "<p>Manage your finanaces on the go with the nonexistent Northern Phish &amp; Loan mobile app!</p>";
        $result .= "<p><a href=\"https://play.google.com/store/apps/details?id=edu.wvncc.northernphish\" target=\"_blank\">Download from Google Play for Android</a></p>";
        $result .= "</div>";
        $result .= "</section>";
    }
    if($useSideContent) {
        $result .= "</div>";
    }
    $result .= "<footer>";
    $result .= "<p>This site is for educational purposes only and does not provide financial services.</p>";
    $result .= "<p>Copyright © 2025 West Virginia Northern Community College, Department of Computer Information Technology.</p>";
    $result .= "</footer>";
    $result .= "</body>";
    $result .= "</html>";
    return $result;
}