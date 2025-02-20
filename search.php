<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
            <?php
                echo "<main id=\"main\">";
                if(array_key_exists("query", $_GET)) {
                    echo "<p>No results found for \"".$_GET["query"]."\"</p>";
                }
                echo "</main>";
            ?>
            <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>