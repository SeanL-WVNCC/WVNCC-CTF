<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
             <?php
                $conn = mysqli_connect("html-db-1", "root", "hackme");
                include "include/vulnconfig.php";
                $includeDirectory = "/var/www/html";
                $pageToInclude = $_GET["page"];
                if($isVulnerableToPathTraversal) {
                    // If path traversal is possible, divulge in comment
                    echo "<!-- INSECURE: this code is vulnerable to a path traversal attack. -->";
                }
                if(file_exists($pageToInclude))  {
                    $pageToInclude = realpath($pageToInclude);
                    // Make sure the included folder is in the "includes" folder... sometimes
                    if(str_starts_with($pageToInclude, $includeDirectory) or $isVulnerableToPathTraversal) {
                        include $pageToInclude;
                    }
                } else {
                    echo "<main></main>";
                }
             ?>
             <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>