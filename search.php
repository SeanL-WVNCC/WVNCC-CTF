<?php
include "include/functions.php";

$mainContent = "";
$mainContent .= "<section class=\"single-column\"aria-labelledby=\"search-results\">";
$mainContent .= "<h2 id=\"search-results\">Search Results</h2>";
if(array_key_exists("query", $_GET)) {
    $query = $_GET["query"];
    $payload = new PayloadCharacteristics($query);
    $reflectedValue = perhapsSanitizeAgainstXss($_GET["query"], XssType::REFLECTED);
    $links = getAllLinksMatchingKeyword($query);
    foreach($links as $link) {
        $mainContent .= "<p>$link</p>";
    }
    
    if(count($links) == 0) {
        
        $mainContent .= "<p>No results found for ".perhapsHideReflected("\"$reflectedValue\"")."</p>";
        if($payload->isXssScriptAttempt()) {
            $mainContent .= "<figure id='the-rock-meme'><img src=img/rock.jpg><figcaption>Hey there buddy. That search query looks a lot like JavaScript.</figcaption></figure>";
            $mainContent .= "<p>Flag 83029</p>";
        }
    }
}
$mainContent .= "</section>";
echo generatePage($mainContent);