<?php
/*
    about-nixon.php
    Intentionally "broken" page with vulnerability hints.
    It also takes POST requests, for some reason:
        `changed-value` - field name in the users table (i.e. username).
        `new-value`     - value to which the field referenced by `changed-value` will be set.
*/
include "include/functions.php";
session_start();
//this is just so hackers only have my worse error messages
error_reporting(0);
$mainContent = "";
//sorry for the giant block this was just the simplest way for me at the moment -Angela
//this has vague hints for figuring out there's a csrf vuln
$junkErrorMessage = "<p>SQL Error: undefined SQL injection error bool TypeError assumed expected robber insecure file object sensitive data exposure constant XSS object TypeError object on object XSS line exception 
assumed error sensitive read this word salad carefully data exposure money unknown SQL , ] global constant cannot uncaught Cannot on XSS global robber near richard nixon bool uncaught local near line 20 use function sensitive data exposure {} 
on error nonsensical bool syntax richard nixon richard nixon exception money unexpected “richard” destroyed empty variables are vulnerable POST[new-value] sensitive data exposure SQL injection object richard nixon constant money insecure file unexpected expected on expected 
insecure file richard nixon error nonsensical find sensitive data exposure SQL injection line 15 unexpected “[” sensitive data exposure cannot be done { , SQL injection money , } bool expected uncaught exception on line 30 unexpected use constant near error line 
destroyed Richard nixon insecure file global destroyed richard CSRF located here nixon 20 unknown variable ‘hey’ near line 3000 insecure file global global undefined robber unknown of find uncaught syntax , use error robber { money nonsensical object find cannot 
of local sensitive data exposure [ 20 local bool undefined unexpected find syntax robber on unexpected [ unexpected 20 TypeError Function unknown object function line richard nixon assumed ] money XSS line XSS assumed sensitive data exposure { expected function TypeError local 
sensitive data exposure object money TypeError use , object ngix insecure file cannot undefined unexpected sensitive data exposure error { robber destroyed object line error object destroyed sensitive data exposure nonsensical XSS function local local global robber uncaught robber 
nonsensical use POST[changed-value] ngix near line 20 destroyed SQL at cannot find constant what sounds real sensitive data exposure global unknown variable global global TypeError TypeError destroyed cannot local { SQL [ , global use money find global at money unexpected uncaught function on at XSS function 
line 1 , constant error at exception SQL injection of constant uncaught 20 on look deeply money nonsensical nonsensical expected ngix bool nonsensical cannot at unknown TypeError cannot SQL 20 local nonsensical find clickjacking assumed { local [ bool syntax function bool richard nixon constant of 
destroyed syntax money error uncaught cannot undefined , find the truth sensitive data exposure near unexpected find } assumed uncaught destroyed unexpected unknown find sensitive data exposure } lines somewhere</p>";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_COOKIE["is-logged-in"])){
        if(($_POST["changed-value"] != "") && ($_POST["new-value"] != "")){
            $conn = connectToDatabase();
            $value = $_POST["new-value"];
            $changed = $_POST["changed-value"];
            $userId = $_COOKIE["logged-in-user"];
            try {
                $query = "UPDATE users SET $changed=\"$value\" WHERE userId=\"$userId\"";
                $conn->query($query);
                $mainContent .= "<p>Richard Nixon Facts: He existed. He also knows you successfully pulled off CSRF. Don't ask how he does.</p>";
            } catch (mysqli_sql_exception $error){
                $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
                $mainContent .= "<p>Comic by KC Green</p>";
                $mainContent .= "<p>$error</p>";
            }
        } elseif(($_POST["changed-value"] == "") && ($_POST["new-value"] == "")){
            $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
            $mainContent .= "<p>Comic by KC Green</p>";
            $mainContent .= "<p>SQL Error: Missing values</p>";
        } elseif($_POST["new-value"] == ""){
            $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
            $mainContent .= "<p>Comic by KC Green</p>";
            $mainContent .= "<p>SQL Error: Empty value</p>";
        } elseif($_POST["changed-value"] == ""){
            $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
            $mainContent .= "<p>Comic by KC Green</p>";
            $mainContent .= "<p>SQL Error: Empty column</p>";
        } else {
            $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
            $mainContent .= "<p>Comic by KC Green</p>";
            $mainContent .= "<p class=\"hidden-search\">CSRF Vulnerability Must Be Fixed</p>";
            $mainContent .= $junkErrorMessage;
        }
    } else {
        $mainContent .= "<p>ERROR: BROKEN PAGE. Full error message below!</p>";
        $mainContent .= "<p>Possible vulnerabilities we need to fix up right away! Our clients depend on us!</p>";
        $mainContent .= "<img src=\"img/this-is-fine.png\"/>";
        $mainContent .= "<p>Comic by KC Green</p>";
        $mainContent .= "<p>DO NOT BE LIKE THIS DOG!</p>";
        $mainContent .= "<p>This is urgent!</p>";
        $mainContent .= "<p class=\"hidden-search\">'changed-value' and 'new-value' are vulnerable</p>";
        $mainContent .= "<p class=\"hidden-search\">CSRF Vulnerability Must Be Fixed</p>";
        $mainContent .= $junkErrorMessage;
        $mainContent .= "<p class=\"hidden-search\">CSRF Vulnerability Must Be Fixed</p>";
    }
} else {
    $mainContent .= "<p>You aren't supposed to be here yet.</p>";
}

echo generatePage(singleColumnLayout($mainContent));
