<?php
include "include/functions.php";
include "include/vulnconfig.php";
$mainContent = "";
$mainContent .= "<section class=\"single-column\"aria-labelledby=\"search-results\">";
$mainContent .= "<h2 id=\"search-results\">Search Results</h2>";
if(array_key_exists("query", $_GET)) {
    $query = $_GET["query"];
    // See if the user's query looks like a reflected XSS attack
    if(str_contains($query, "<script>")) {
        $looksLikeXss = True;
    } else {
        $looksLikeXss = False;
    }
    if(str_contains($query, "<script>")) {
        $looksLikeXss = True;
    } else {
        $looksLikeXss = False;
    }
    if($isVulnerableToReflectedXss) {
        $valueToDisplay = $_GET["query"];
        
    } else {
        $valueToDisplay = htmlspecialchars($_GET["query"]);
    }
    $keyTerms = array(
        array("login", "log", "account", "sign"),
        array("create", "register", "sign", "account"),
        array("feedback", "comment", "complain", "fourm", "contact", "message", "chat"),
        array("about", "history", "managment", "call", "contact", "number", "address", "nixon"),
        array("download", "app"),
        array("contract", "legal", "term", "arbitration", "privacy", "agreement"),
    );
    $resultingPages = array(
        array("login.php", "Log in to your account"),
        array("register.php", "Sign up for an account"),
        array("feedback.php", "Tell us how we're doing"),
        array("about.php", "About Northern Phish &amp; Loan"),
        array("https://play.google.com/store/apps/details?id=edu.wvncc.northernphish", "Download our app"),
        array("legal.php", "Terms of Service")
    );
    $index = 0;
    $searchHits = 0;
    while($index < count($keyTerms)) {
        foreach($keyTerms[$index] as $term) {
            if(str_contains(strtolower($valueToDisplay), $term)) {
                $linkLocation = $resultingPages[$index][0];
                $anchorText = $resultingPages[$index][1];
                $mainContent .= "<p><a href='$linkLocation'>$anchorText</a></p>";
                $searchHits += 1;
            }
        }
        $index += 1;
    }
    
    if($searchHits == 0) {
        //Two different ways of hiding the result in the background

        //og echo without the class/span just for testing if needed:
        //$mainContent .= "<p>No results found for \"".$valueToDisplay."\"</p>";
        
        /*Colors all the text the same as the body background color
        $mainContent .= "<p class='hidden-search'>No results found for \"".$valueToDisplay."\"</p>";*/
        
        //Only colors the result itself
        global $hideReflectionWithTransparentText;
        if($hideReflectionWithTransparentText) {
            $mainContent .= "<p>No results found for <span class=\"hidden-reflected-user-input\">\"".$valueToDisplay."\"</span></p>";
        } else {
            $mainContent .= "<p>No results found for \"$valueToDisplay\"</span></p>";
        }
        if($looksLikeXss) {
            $mainContent .= "<figure id='the-rock-meme'><img src=img/rock.jpg><figcaption>Hey there buddy. That search query looks a lot like JavaScript.</figcaption></figure>";
            $mainContent .= "<p>Flag 83029</p>";
        }
    }
}
$mainContent .= "</section>";
echo generatePage($mainContent);