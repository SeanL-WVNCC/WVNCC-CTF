<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <div>
            <?php include 'include/secondary-nav.php';?>
            <main id="main">
                <form aria-labelledby="send-feedback-heading" method="GET", action="feedback.php">
                    <h2 id="send-feedback-heading">Send Feedback</h2>
                    <!-- Hidden fields, please do not tamper -->
                    <input id="username-field" type="hidden" name="username" required>
                    <input id="date-field" type="hidden" name="date" required>
                    <label for="feedback">Feedback</label><br>
                    <input id="feedback" type="text" name="feedback" autofocus required>
                    <button type="submit">Send Feedback</butto>
                    <!-- No need for a clear fields input -->
                </form>
            </main>
             <?php include 'include/featured.php';?>
        </div>
        <?php include "include/footer.php" ?>
    </body>
</html>