<?php
/*
    auth.php
    Code for authenticating users and managing sessions.
*/
include "/var/www/html/include/pagegen.php";
include "/var/www/html/include/user.php";

/**
 * This gets sent back whenever you try to log in.
 * It contains some status messages for how the login attempt went.
 */
class AuthenticationResult {
    public int $userId;
    public string $username;
    public string $usernameErrorMessage;
    public string $passwordErrorMessage;
    public string $statusMessage;
    public string $queryExecuted;
    public bool $isSuccess;
    public bool $isAuthenticationBypassSuccess;

    public function __construct(int $userId, string $username, string $statusMessage, string $usernameErrorMessage, string $passwordErrorMessage, string $queryExecuted, bool $isSuccess, bool $isAuthenticationBypassSuccess) {
        $this->userId = $userId;
        $this->username = $username;
        $this->usernameErrorMessage = $usernameErrorMessage;
        $this->passwordErrorMessage = $passwordErrorMessage;
        $this->statusMessage = $statusMessage;
        $this->queryExecuted = $queryExecuted;
        $this->isSuccess = $isSuccess;
        $this->isAuthenticationBypassSuccess = $isAuthenticationBypassSuccess;
    }
}

/**
 * Queries the DB for a user matching the given credentials.
 * @param string $username
 * @param string $password
 * @return AuthenticationResult Details about the login attempt.
 */
function authenticate(string $username, string $password): AuthenticationResult {

    // NOTE: This function is way too long.

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
                    $usernameErrorMessage = "Username \"" . perhapsHideReflected($username) . "\" not found.";
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
    $isAuthenticationBypass = false;
    if(isset($user)) {
        if(($password != $user["password"]) && $isSuccess) {
            $isAuthenticationBypass = true;
            $statusMessage = "Logged in successfully.<br>Flag: <a href=\"https://portswigger.net/support/using-sql-injection-to-bypass-authentication\" target=\"_blank\">Authentication Bypass via SQL injection</a>";
        }
    }
    return new AuthenticationResult($userId, $username, $statusMessage, $usernameErrorMessage, $PasswordErrorMessage, $queryExecuted, $isSuccess, $isAuthenticationBypass);
}

/**
 * Gets the user that's logged in, `null` if the user isn't logged in.
 * @return User|null
 */
function getCurrentUser() {
    if(isset($_COOKIE["logged-in-user"])) {
        return userFromId($_COOKIE["logged-in-user"]);
    }
    return null;
}
function isLoggedIn() {
    return isset($_COOKIE["logged-in-user"]);
}

/**
 * Sets the cookies to log the user in.
 * @param int $userId The ID of the user to log in.
 * @return void
 */
function login(int $userId) {
    setcookie("logged-in-user", $userId, 0, "/");
}

/**
 * Sets the cookies to log the user out.
 * @return void
 */
function logout() {
    setcookie('logged-in-user', '', -1, '/');
}