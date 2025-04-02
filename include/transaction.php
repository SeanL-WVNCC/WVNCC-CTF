<?php
/*
    transaction.php
    Code for representing and managing trasnactions in the DB.
*/


class Transaction {
    public int $transactionId;
    public int $debitAccountId;
    public int $creditAccountId;
    public float $amount;
    public DateTime $transactionTime;
    public DateTime $postedTime;
    public string $description;
    public function __construct(int $transactionId, int $debitAccountId, int $creditAccountId, float $amount, DateTime $transactionTime, DateTime $postedTime, string $description) {
        $this->transactionId = $transactionId;
        $this->debitAccountId = $debitAccountId;
        $this->creditAccountId = $creditAccountId;
        $this->amount = $amount;
        $this->transactionTime = $transactionTime;
        $this->postedTime = $postedTime;
        $this->description = $description;
    }
    public static function fromAsocArray(array $transactionObj): Transaction {
        return new Transaction(
            $transactionObj["transactionId"],
            $transactionObj["debitAccountId"],
            $transactionObj["creditAccountId"],
            $transactionObj["amount"],
            new DateTime($transactionObj["transactionTime"]),
            new DateTime($transactionObj["postedTime"]),
            $transactionObj["description"]
        );
    }
}

/**
 * Queries the DB for a particular transaction. `null` if it does not exist.
 * @return Transaction|null
 */
function transactionFromId(int $transactionId): Transaction|null {
    global $isVulnerableToSqlInjection;
    $database = connectToDatabase();
    try {
        if($isVulnerableToSqlInjection) {
            return Transaction::fromAsocArray($database->query("SELECT * FROM transactions WHERE transactionId=$transactionId")->fetch_assoc());
        } else {
            $query = $database->prepare("SELECT * FROM transactions WHERE transactionId=?");
            $query->bind_param("i", $transactionId);
            $query->execute();
            $queryResult = $query->get_result();
            if(is_bool($queryResult)) {
                return null;
            } else {
                return Transaction::fromAsocArray($queryResult->fetch_assoc());
            }
        }
    } catch(mysqli_sql_exception $error) {
        return null;
    }
}

/**
 * Quaeries the DB for all transactions matching an account number.
 * @param int $accountNumber The account number to search.
 * @return array A list of Transaction objects.
 */
function transactionsInvolvingAccount(int $accountNumber) {
    global $isVulnerableToSqlInjection;
    $database = connectToDatabase();
    $transactions = array();
    try {
        if($isVulnerableToSqlInjection) {
            $q = $database->query("SELECT * FROM transactions WHERE (creditAccountId=$accountNumber) OR (debitAccountId=$accountNumber)");
            while($transaction = $q->fetch_assoc()) {
                array_push($transactions, Transaction::fromAsocArray($transaction));
            }
        } else {
            $query = $database->prepare("SELECT * FROM transaction WHERE (creditAccountId=?) OR (debitAccountId=?)");
            $query->bind_param("ii", $accountNumber, $accountNumber);
            $query->execute();
            $queryResult = $query->get_result();
            if(is_bool($queryResult)) {
                return array();
            } else {
                while($transaction = $queryResult->fetch_assoc()) {
                    array_push($transactions, $transaction);
                }
            }
        }
    } catch(mysqli_sql_exception $error) {
        return array();
    }
    return $transactions;
}