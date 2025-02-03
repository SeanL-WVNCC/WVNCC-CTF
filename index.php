<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <!-- INSECURE: this code is vulnerable to a path traversal attack. -->
        <?php include $_GET["page"] ?>
        <?php include "include/footer.php" ?>
    </body>
</html>