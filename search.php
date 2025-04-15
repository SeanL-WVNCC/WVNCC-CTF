<?php
/*
    search.php
    Endpoint for the site-wide keyword search.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$banner = createBanner("Search Results", "", "/img/search-banner.jpg");
if(array_key_exists("query", $_GET)) {
    $query = $_GET["query"];
    $payload = new PayloadCharacteristics($query);
    $reflectedValue = perhapsSanitizeAgainstXss($query, XssType::REFLECTED);
    $links = getAllLinksMatchingKeyword($query);
    foreach($links as $link) {
        $mainContent .= "<p>$link</p>";
    }
    
    if(count($links) == 0) {
        // No results for the user's search query. Reflected XSS time!
        $mainContent .= "<p>No results found for ".perhapsHideReflected("\"$reflectedValue\"")."</p>";
        if($payload->isXssScriptAttempt()) {
            $mainContent .= "<figure id='the-rock-meme'><img src=img/rock.jpg><figcaption>Hey there buddy. That search query looks a lot like JavaScript.</figcaption></figure>";
            $mainContent .= "<p>Flag: <a href=\"https://owasp.org/www-community/attacks/xss/\" target=\"_blank\">Reflected XSS</a></p>";
        }
    }
} else {
    $mainContent .= "<p>Please enter your search query in the top right.</p>";
}
echo generatePage($banner . singleColumnLayout($mainContent));