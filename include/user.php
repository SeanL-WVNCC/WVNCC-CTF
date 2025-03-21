<?php
/*
    user.php
    Code for representing and managing users in the DB.
*/
class User {
    public int $userId;
    public string $username;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;
    public bool $isAdmin;
    public function __construct(int $userId, string $username, string $password, string $firstName, string $lastName, string $email, bool $isAdmin) {
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }
    public static function fromAsocArray(array $userObj): User {
        return new User(
            $userObj["userId"],
            $userObj["username"],
            $userObj["password"],
            $userObj["firstName"],
            $userObj["lastName"],
            $userObj["email"],
            $userObj["isAdmin"],
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