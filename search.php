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
                    //Two different ways of hiding the result in the background

                    //og echo without the class/span just for testing if needed:
                    //$output .= "<p>No results found for \"".$valueToDisplay."\"</p>";
                    
                    /*Colors all the text the same as the body background color
                    $output .= "<p class='hidden-search'>No results found for \"".$valueToDisplay."\"</p>";*/

                    //Only colors the result itself
                    $output .= "<p>No results found for <span style='color:#FCECE5'>\"".$valueToDisplay."\"</span></p>";

                    if($looksLikeXss) {
                        $output .= "<figure id='the-rock-meme'><img src=img/rock.jpg><figcaption>Hey there buddy. That search query looks a lot like JavaScript.</figcaption></figure>";
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
