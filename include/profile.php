<main id="main" >
    <form id="open-account-form" aria-labelledby="open-account">
        <h2 id="open-account">Edit Account</h2>
        <p>This is a placeholder form.</p>
        <!-- Users should not be able to modify these hidden fields -->
        <input type="hidden" name="account-number" value="This is a placeholder">
        <label for="action-field">Choose an action</label>
        <select id="action-field" name="action" autofocus required>
            <option value="">--Select action--</option>
            <option value="close">Close my account</option>
            <option value="scam">Wire all of my money to an account in Belarus</option>
        </select>
        <button type="submit">Submit request</button>
    </form>
</main>