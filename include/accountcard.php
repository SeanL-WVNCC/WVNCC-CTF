<?php
/*
    accountcard.php
    Generates the account preview card in the dashboard.
*/
include "include/bankaccount.php";

function generateAccountCard(BankAccount $account, $currentBalance) {
    $html = "";
    $dollars = floor($currentBalance);
    $cents = floor($currentBalance * 100) % 100;
    if(strlen("".$cents) < 2) {
        $cents = "0".$cents;
    }
    $accountName = perhapsSanitizeAgainstXss($account->nickname, XssType::STORED);
    $accountNumber = $account->accountNumber;
    $accountType = $account->accountType->toString();
    $label = "$accountName account, $accountType number ".implode("", str_split($accountNumber)).". $dollars dollars and $cents cents, current balance.";
    $accountNameAndNumberSection = "<div class=\"account-name-and-number-section\"><img src=\"img/bank-icon.svg\" alt=\"\"><div class=\"account-type-section\"><p class=\"account-name\">$accountName account</p><p>$accountType #$accountNumber</p></div></div>";
    $accountBalanceSection = "<div class=\"account-balance-section\"><p class=\"account-balance\">$$dollars.$cents</p><p>Current balance</p></div>";
    $html .= "<a href=\"/account.php?account-number=$accountNumber\" class=\"account-card\" aria-label=\"$label\">$accountNameAndNumberSection$accountBalanceSection</a>";
    return $html;
}

function generateAccountCards(array $accounts) {
    $html = "";
    foreach($accounts as $account) {
        $html .= generateAccountCard($account, 0);
    }
    return $html;
}