<?php
/*
    include/search.php
    Code enabling the keyword search feature
*/
include "include/vulnconfig.php";

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

function getAllKeywords() {
    global $keyTerms;
    $result = array();
    foreach($keyTerms as $catagory) {
        $result = array_unique(array_merge($result, $catagory));
    }
    return $result;
}

function getAllLinksMatchingKeyword(string $keyword) {
    global $keyTerms;
    global $resultingPages;
    $index = 0;
    $result = array();
    while($index < count($keyTerms)) {
        foreach($keyTerms[$index] as $term) {
            if(str_contains(strtolower($keyword), $term)) {
                $linkLocation = $resultingPages[$index][0];
                $anchorText = $resultingPages[$index][1];
                array_push($result, "<a href='$linkLocation'>$anchorText</a>");
            }
        }
        $index += 1;
    }

    return $result;
}