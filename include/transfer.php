<main id="main" >
    <form id="transfer-funds-form" aria-labelledby="transfer-funds-form">
        <h2 id="open-account">Funds transfer</h2>
        <!-- Users cannot edit the source-account-number field -->
        <label for="source-account-number-field">From account</label>
        <input id="source-account-number-field" type="text" name="source-account-number" value="00000001234" disabled>
        <label for="destination-account-number-field">To account</label>
        <input id="destination-account-number-field" type="text" name="destination-account-number" autofocus>
        <label for="account-nickname-field">Amount</label>
        <input id="amount-field" type="number" name="amount">
        <button type="submit">Transfer</button>
    </form>
</main>