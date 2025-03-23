<?php
/*
    accountcard.php
    Generates the account preview card in the dashboard.
*/

function generateAccountCard(string $accountName, string $accountNumberLastFour, float $currentBalance, string $linkHref) {
    $html = "";
    $dollars = floor($currentBalance);
    $cents = floor($currentBalance * 100) % 100;
    if(strlen("".$cents) < 2) {
        $cents = "0".$cents;
    }
    $label = "$accountName account, Account number ".implode("", str_split($accountNumberLastFour)).". $dollars dollars and $cents cents, current balance.";
    $accountNameAndNumberSection = "<div class=\"account-name-and-number-section\"><img src=\"img/bank-icon.svg\" alt=\"\"><div class=\"account-type-section\"><p class=\"account-name\">$accountName account</p><p>Account #$accountNumberLastFour</p></div></div>";
    $accountBalanceSection = "<div class=\"account-balance-section\"><p class=\"account-balance\">$$dollars.$cents</p><p>Current balance</p></div>";
    $html .= "<a href=\"$linkHref\" class=\"account-card\" aria-label=\"$label\">$accountNameAndNumberSection$accountBalanceSection</a>";
    return $html;
}