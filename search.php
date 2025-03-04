<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
            <?php
                include "include/vulnconfig.php";
                echo "<main id=\"main\">";
                $output = "";
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
                        array("about", "history", "managment", "ceo", "call", "contact", "number", "address"),
                        array("download", "app"),
                    );
                    $resultingPages = array(
                        array("login.php", "Log in to your account"),
                        array("index.php?page=include/register.php", "Sign up for an account"),
                        array("feedback.php", "Tell us how we're doing"),
                        array("index.php?page=include/about.php", "About Northern Phish &amp; Loan"),
                        array("https://play.google.com/store/apps/details?id=edu.wvncc.northernphish", "Download our app")
                    );
                    $index = 0;
                    $searchHits = 0;
                    while($index < count($keyTerms)) {
                        foreach($keyTerms[$index] as $term) {
                            if(str_contains(strtolower($valueToDisplay), $term)) {
                                $linkLocation = $resultingPages[$index][0];
                                $anchorText = $resultingPages[$index][1];
                                $output .= "<p><a href='$linkLocation'>$anchorText</a></p>";
                                $searchHits += 1;
                            }
                        }
                        $index += 1;
                    }
                    
                    if($searchHits == 0) {
                        //Two different ways of hiding the result in the background

                        //og echo without the class/span just for testing if needed:
                        //$output .= "<p>No results found for \"".$valueToDisplay."\"</p>";
                        
                        /*Colors all the text the same as the body background color
                        $output .= "<p class='hidden-search'>No results found for \"".$valueToDisplay."\"</p>";*/

                        //Only colors the result itself
                        $output .= "<p>No results found for <span style='color:#FCECE5'>\"".$valueToDisplay."\"</span></p>";

                        if($looksLikeXss) {
                            $output .= "<figure id='the-rock-meme'><img src=img/rock.jpg><figcaption>Hey there buddy. That search query looks a lot like JavaScript.</figcaption></figure>";
                            $output .= "<p>Flag 83029<p>";
                        }
                    }
                    
                    echo $output;
                }
                echo "</main>";
            ?>
            <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>
