<?php
function generatePage(string $mainContent, bool $useSideContent): string {
    // TODO: Break this into smaller functions
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
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/main.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/footer.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/home.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/media-queries.css\">";
    $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/important.css\">";
    $result .= "<link rel=\"icon\" type=\"img/x-icon\" href=\"./img/logo.png\">";
    $result .= "<script src=\"./js/script.js\"></script>";
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
        $result .= "<li><button id=\"online-banking-menu-button\" type=\"button\" aria-expanded=\"false\" aria-controls=\"online-banking-dropdown\" onclick=\"toggleExpandButton('online-banking-menu-button')\" keydown=\"keypressEventDisclouseButton\">Online Banking</button>";
        $result .= "<ul id=\"online-banking-dropdown\" hidden>";
        //$result .= "<li><a href=\"dashboard.php\">Dashboard</a></li>";
        //$result .= "<li><a href=\"mobile-deposit.php\">Mobile deposit</a></li>";
        //$result .= "<li><a href=\"transfer.php\">Funds transfer</a></li>";
        //$result .= "<li><a href=\"new-account.php\">Open account</a></li>";
        //$result .= "<li><a href=\"profile.php\">Profile</a></li>";
        $result .= "<li><a href=\"logout.php\">Log Out</a></li>";
        $result .= "</ul>";
        $result .= "</li>";
        $result .= "<li><a href=\"feedback.php\">Feedback</a></li>";
    } else {
        $result .= "<li><a href=\"login.php\">Login</a></li>";
        $result .= "<li><a href=\"register.php\">Register</a></li>";
    }
    $result .= "<li><button id=\"about-menu-button\" type=\"button\" aria-expanded=\"false\" aria-controls=\"about-dropdown\" onclick=\"toggleExpandButton('about-menu-button')\" keydown=\"keypressEventDisclouseButton\">About</button>";
    $result .= "<ul id=\"about-dropdown\" hidden>";
    $result .= "<li><a href=\"accounts.php\">Accounts</a></li>";
    $result .= "<li><a href=\"about.php\">About Us</a></li>";
    $result .= "<li><a href=\"legal.php\">Legal</a></li>";
    $result .= "</ul>";
    $result .= "</li>";
    $result .= "</ul>";
    $result .= "</nav>";
    $searchIcon = "<svg id=\"fsa_HeaderButtonWebSearchToggle\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z\"></path></svg>";
    $result .= "<form role=\"search\" method=\"GET\" action=\"search.php\">";
    $result .= "<input id=\"query-field\" type=\"search\" name=\"query\" required aria-labelledby=\"search-button\" title=\"Search site by keyword\" placeholder=\"Search keywords\">";
    $result .= "<button id=\"search-button\" type=\"submit\" aria-label=\"Search\">$searchIcon</button>";
    $result .= "</form>";
    $result .= "</header>";
    $result .= "<main id=\"main\">$mainContent</main>";
    $result .= "<footer>";
    $result .= "<p>This site is for educational purposes only and does not provide financial services.</p>";
    $result .= "<p>Copyright © 2025 West Virginia Northern Community College, Department of Computer Information Technology.</p>";
    $result .= "</footer>";
    $result .= "</body>";
    $result .= "</html>";
    return $result;
}

function isLoggedIn() {

}