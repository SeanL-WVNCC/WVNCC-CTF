<?php
/*
    functions.php
    Include this file to get all of the cool stuff.
*/
include "include/vulnconfig.php";
include "include/pagegen.php";
include "include/formgen.php";

class PayloadCharacteristics {
    public string $payload;
    public function __construct(string $payload) {
        $this->payload = $payload;
    }
    public function isQuoteInjectionAttempt(): bool {
        return str_starts_with($this->payload, "'") || str_starts_with($this->payload, "\"");
    }
    public function isSqlCommentInjectionAttempt(): bool {
        return str_contains($this->payload, "--");
    }
    public function isSqlDeletionAttempt(): bool {
        $payload = strtoupper($this->payload);
        return str_contains($payload, "DELETE") || str_contains($payload, "DROP");
    }
    public function isSqlInjectionAttempt(): bool {
        return $this->isQuoteInjectionAttempt() || $this->isSqlCommentInjectionAttempt() || $this->isSqlDeletionAttempt();
    }
    public function isXssAttempt(): bool {
        return str_contains($this->payload, "<") && str_contains($this->payload, ">");;
    }
    public function isSuspect(): bool {
        return $this->isSqlInjectionAttempt() || $this->isXssAttempt();
    }
}

/**
 * Connects to the 'breakTheBank' database.
 * @return bool|mysqli The Database connection.
 */
function connectToDatabase(): mysqli {
    return mysqli_connect("db", "root", "hackme", "breakTheBank");
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
 * @return array|bool|null
 */
function userFromId(int $userId) {
    global $isVulnerableToSqlInjection;
    $database = connectToDatabase();
    try {
        if($isVulnerableToSqlInjection) {
            return $database->query("SELECT * FROM users WHERE userId=$userId")->fetch_assoc();
        } else {
            $query = $database->prepare("SELECT * FROM users WHERE userId=?");
            $query->bind_param("i", $$userId);
            $query->execute();
            $queryResult = $query->get_result();
            if(is_bool($queryResult)) {
                return null;
            } else {
                return $queryResult->fetch_assoc();
            }
        }
    } catch(mysqli_sql_exception $error) {
        return null;
    }
}