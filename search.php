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
                if(array_key_exists("query", $_GET)) {
                    if($isVulnerableToReflectedXss) {
                        $valueToDisplay = $_GET["query"];
                    } else {
                        $valueToDisplay = htmlspecialchars($_GET["query"]);
                    }
                    //Two different ways of hiding the result in the background

                    //og echo without the class/span just for testing if needed:
                    //echo "<p>No results found for \"".$valueToDisplay."\"</p>";

                    /*Colors all the text the same as the body background color
                    echo "<p class='hidden-search'>No results found for \"".$valueToDisplay."\"</p>";*/

                    //Only colors the result itself
                    echo "<p>No results found for <span style='color:#FCECE5'>\"".$valueToDisplay."\"</span></p>";
                }
                echo "</main>";
            ?>
            <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>
