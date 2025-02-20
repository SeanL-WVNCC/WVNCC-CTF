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
                    echo "<p>No results found for \"".$valueToDisplay."\"</p>";
                }
                echo "</main>";
            ?>
            <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>