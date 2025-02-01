<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <!--Typical bank website elements-->
        <main>
            <form aria-labelledby="send-feedback-heading">
                <h2 id="send-feedback-heading">Send Feedback</h2>
                <label for="uName">Username</label><br>
                <input type="text" id="uName" name="uName" required><br><br>
                <label for="feedbackDate">Date</label><br>
                <input type="date" id="feedbackDate" name="feedbackDate" required><br><br>
                <label for="feedback">Feedback</label><br>
                <input type="text" id="feedback" name="feedback" required><br><br>
                <button type="submit" >Send Feedback</button>
                <button type="reset">Clear Fields</button>
            </form>
        </main>
        <?php include "include/footer.php" ?>
    </body>
</html>