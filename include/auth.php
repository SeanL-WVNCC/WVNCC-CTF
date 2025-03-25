<?php
/*
    auth.php
    Code for authenticating users and managing sessions.
*/
include "include/pagegen.php";
include "include/user.php";

class AuthenticationResult {
    public int $userId;
    public string $username;
    public string $usernameErrorMessage;
    public string $passwordErrorMessage;
    public string $statusMessage;
    public string $queryExecuted;
    public bool $isSuccess;

    public function __construct(int $userId, string $username, string $statusMessage, string $usernameErrorMessage, string $passwordErrorMessage, string $queryExecuted, bool $isSuccess) {
        $this->userId = $userId;
        $this->username = $username;
        $this->usernameErrorMessage = $usernameErrorMessage;
        $this->passwordErrorMessage = $passwordErrorMessage;
        $this->statusMessage = $statusMessage;
        $this->queryExecuted = $queryExecuted;
        $this->isSuccess = $isSuccess;
    }
}

/**
 * Queries the DB for a user matching the given credentials.
 * @param string $username
 * @param string $password
 * @return AuthenticationResult Details about the login attempt.
 */
function authenticate(string $username, string $password): AuthenticationResult {
    $database = connectToDatabase();
    $queryExecuted = "";
    global $isVulnerableToSqlInjection;
    $sqlExceptionThrown = false;
    $usernameErrorMessage = "";
    $PasswordErrorMessage = "";
    $statusMessage = "";
    if($isVulnerableToSqlInjection) {
        try {
            $usernameAndPasswordQuery = "SELECT * FROM users WHERE username=\"$username\" AND password=\"$password\"";
            $queryExecuted = $usernameAndPasswordQuery;
            $result = $database->query($usernameAndPasswordQuery);
        } catch(mysqli_sql_exception $error) {
            $statusMessage = "<div class=\"error-block\"><p>Invalid SQL: <samp>SELECT * FROM users WHERE username=\"<u>$username\" AND password=\"$password\"</u></samp></p>";
            if(str_starts_with($username, '"')) {
                $statusMessage .= "<p>Content following quote appears to be invalid.</p></div>";
            }
            $sqlExceptionThrown = true;
        }
    } else {
        try {
            $query = $database->prepare("SELECT * FROM users WHERE username=? AND password=?");
            $query->bind_param("ss", $username, $password);
            $query->execute();
            $result = $query->get_result();
        }catch(mysqli_sql_exception $error) {
            $statusMessage = "The server seems to be experiencing technical difficulties. If the problem persists, alert Northern Phish.";
            $sqlExceptionThrown = true;
        }
        
    }
    
    $userId = 0;
    
    $user = null;
    if(isset($result)) {
        if($result) {
            $user = $result->fetch_assoc();
        }
    }
    if($user) {
        $userId = $user["userId"];
        $statusMessage = "Logged in successfully.";
        $isSuccess = true;
    } else {
        // The username and password were incorrect.
        // Should we disclose which one?
        global $isVulnerableToUserEnum;
        if(!$sqlExceptionThrown) {
            if($isVulnerableToUserEnum) {
                // Yes (We need to ask the DB tho)
                if(userDoesExist($username)) {
                    $PasswordErrorMessage = "Password Incorrect.";
                    $statusMessage = "Login failed.";
                } else {
                    global $hideReflectionWithTransparentText;
                    if($hideReflectionWithTransparentText) {
                        $usernameErrorMessage = "Username <span class=\"hidden-reflected-user-input\">\"$username\"</span> not found.";
                    } else {
                        $usernameErrorMessage = "Username \"$username\" not found.";
                    }
                    $statusMessage = "Login failed.";
                }
            } else {
                // No.
                $statusMessage = "The supplied username and password don't match any of our records.";
            }
        }
        $isSuccess = false;
    }
    $usernamePayload = new PayloadCharacteristics($username);
    $passwordPayload = new PayloadCharacteristics($password);
    if(!$isVulnerableToSqlInjection && ($usernamePayload->isSqlInjectionAttempt() || $passwordPayload->isSqlInjectionAttempt())) {
        $statusMessage .= "<div>No SQL injection here, sorry 🤷</div>";
    }
    return new AuthenticationResult($userId, $username, $statusMessage, $usernameErrorMessage, $PasswordErrorMessage, $queryExecuted, $isSuccess);
}

function getCurrentUser() {
    if(isset($_COOKIE["logged-in-user"])) {
        return userFromId($_COOKIE["logged-in-user"]);
    }
    return null;
}
function isLoggedIn() {
    return isset($_COOKIE["is-logged-in"]);
}

/**
 * Sets the cookies to log the user in.
 * @param int $userId The ID of the user to log in.
 * @return void
 */
function login(int $userId) {
    setcookie("is-logged-in", "true");
    setcookie("logged-in-user", $userId);
}

/**
 * Sets the cookies to log the user out.
 * @return void
 */
function logout() {
    setcookie('is-logged-in', '', -1, '/');
    setcookie('logged-out-user', '', -1, '/');
}