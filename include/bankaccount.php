<?php
/*
    bankaccount.php
    Code for representing and managing bank accounts in the DB.
*/

enum AccountType {
    case CHECKING;
    case SAVING;
    case DARK_VAULT_CREDIT;
    case MORGAGE;

    static function fromString(string $accountType) {
        
        $type = strtolower($accountType);
        if($type == "saving") {
            return AccountType::SAVING;
        } else if(str_contains($type, "dark vault")) {
            return AccountType::DARK_VAULT_CREDIT;
        } else if($type == "morgage") {
            return AccountType::MORGAGE;
        } else {
            // idk lol just give them a checking account
            return AccountType::CHECKING;
        }
    }
    function toString() {
        switch($this) {
            case AccountType::CHECKING: return "checking";
            case AccountType::SAVING: return "saving";
            case AccountType::DARK_VAULT_CREDIT: return "dark vault credit";
            case AccountType::MORGAGE: return "morgage";
        }
    }
}
class BankAccount {
    public int $accountNumber;
    public string $userId;
    public AccountType $accountType;
    public string $nickname;
    public function __construct(int $accountNumber, string $userId, AccountType $accountType, string $nickname) {
        $this->accountNumber = $accountNumber;
        $this->userId = $userId;
        $this->accountType = $accountType;
        $this->nickname = $nickname;
    }
    public static function fromAsocArray(array $accountObj): BankAccount {
        return new BankAccount(
            $accountObj["accountNumber"],
            $accountObj["userId"],
            $accountObj["accountType"],
            $accountObj["nickname"],
        );
    }
}

function userDoesExist(string $username): bool {
    global $isVulnerableToSqlInjection;
    $database = connectToDatabase();
    try {
        if($isVulnerableToSqlInjection) {
            return (bool)$database->query("SELECT * FROM users WHERE username=\"$username\"")->fetch_assoc();
        } else {
            $query = $database->prepare("SELECT * FROM users WHERE username=?");
            $query->bind_param("s", $username);
            $query->execute();
            $queryResult = $query->get_result();
            if(is_bool($queryResult)) {
                return $queryResult;
            } else {
                return (bool)$queryResult->fetch_assoc();
            }
        }
    } catch(mysqli_sql_exception $error) {
        return false;
    }
}

/**
 * Given a user ID, returns an array object representing the user from the database.
 * @param int $userId The user's numeric ID
 */
function userFromId(int $userId) {
    global $isVulnerableToSqlInjection;
    $database = connectToDatabase();
    try {
        if($isVulnerableToSqlInjection) {
            return User::fromAsocArray($database->query("SELECT * FROM users WHERE userId=$userId")->fetch_assoc());
        } else {
            $query = $database->prepare("SELECT * FROM users WHERE userId=?");
            $query->bind_param("i", $$userId);
            $query->execute();
            $queryResult = $query->get_result();
            if(is_bool($queryResult)) {
                return null;
            } else {
                User::fromAsocArray($queryResult->fetch_assoc());
                
            }
        }
    } catch(mysqli_sql_exception $error) {
        return null;
    }
}