<main id="main">
    <form aria-labelledby="send-feedback-heading">
        <h2 id="send-feedback-heading">Send Feedback</h2>
        <!-- Hidden fields, please do not tamper -->
        <input type="hidden" id="uName" name="uName" required>
        <input type="hidden" id="feedbackDate" name="feedbackDate" required>
        <label for="feedback">Feedback</label><br>
        <input id="feedback" type="text" name="feedback" autofocus required>
        <button type="submit" >Send Feedback</button>
        <!-- No need for a clear fields input -->
    </form>
</main>