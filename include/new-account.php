<main id="main" >
    <form id="open-account-form" aria-labelledby="open-account">
        <h2 id="open-account">Open a new account</h2>
        <!-- Users should not be able to modify these hidden fields -->
        <input type="hidden" name="account-number" value="This is a placeholder">
        <label for="account-type-field">Account type</label>
        <select id="account-type-field" name="account-type" autofocus required>
            <option value="">--Select type--</option>
            <option value="checking">Checking</option>
            <option value="saving">Saving</option>
            <option value="credit">Credit</option>
            <option value="student">Student special</option>
        </select>
        <label for="account-nickname-field">Account nickname</label>
        <input id="account-nickname-field" type="text" name="account-nickname" title="What would you like this account to be called?">
        <button type="submit">Open account</button>
    </form>
</main>