<?php
/*
    daskboard.php
    Page for users to manage their finances. 
*/
session_start();
include "/var/www/html/include/functions.php";

$mainContent = "";
if(isLoggedIn()) {
    $leftColumn = "";
    $rightColumn = "";
    $account = bankAccountFromAccountNumber($_GET["account-number"]);
    $mainContent = "";
    $mainContent = "<div class=\"banner\">";
    $mainContent .= generateAccountCard($account, 0, False);
    $mainContent .= "</div>";
    $mainContent .= "<button aria-expanded=\"false\" disabled>Account options</button>";
    $mainContent .= "<p>Recent transactions</p>";
    $mainContent .= "<table>";
    $mainContent .= "<thead>";
    $mainContent .= "<tr><th>Date</th><th>Description</th><th>Amount</th><th>Balance</th></tr>";
    $mainContent .= "</thread>";
    $mainContent .= "<tbody>";
    $transactions = transactionsInvolvingAccount(1);
    foreach($transactions as $transaction) {
        $amount = $transaction->amount;
        $description = $transaction->description;
        $dateString = $transaction->postedTime->format('d M Y');
        if($transaction->debitAccountId == $account->accountNumber) {
            $amountString = "($$amount)";
        } else {
            $amountString = "$$amount";
        }
        $mainContent .= "<tr><td>$dateString</td><td>$description</td><td>$amountString</td><td>$0.00</td></tr>";
    }
    $mainContent .= "</tbody>";
    $mainContent .= "</table>";
    echo generatePage($mainContent);
}