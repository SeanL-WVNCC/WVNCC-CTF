<?php
include "include/vulnconfig.php";
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
/**
 * Returns HTML that links to the list of stylesheets provided.
 * @param array $stylesheetLocations URLs or file paths to CSS stylesheets, as an array of strings.
 * @return string String of HTML &lt;link&gt; elements that load the stylesheets specified.
 */
function createStylesheetLinks(array $stylesheetLocations): string {

    $result = "";
    foreach($stylesheetLocations as $location) {
        $result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$location\">";
    }
    return $result;
}

/**
 * Returns HTML for the &lt;head&gt; element.
 * @return string The head element.
 */
function createHeadElement(): string {

    $result = "";
    $result .= "<head>";
    $result .= "<meta charset=\"utf-8\">";
    $result .= "<meta name=\"author\" content=\"Everyone's names will go here\">";
    $result .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    $result .= createStylesheetLinks(array("./css/style.css", "./css/header.css", "./css/main.css", "./css/footer.css", "./css/home.css", "./css/simpleform.css", "./css/media-queries.css", "./css/important.css"));
    $result .= "<link rel=\"icon\" type=\"img/x-icon\" href=\"./img/logo.png\">";
    $result .= "<script src=\"./js/script.js\"></script>";
    $result .= "<title>Northern Phish &amp; Loan</title>";
    $result .= "</head>";
    return $result;
}

/**
 * Returns HTML for the &lt;header&gt; element.
 * @return string The header element.
 */
function createHeaderElement(): string {

    $result = "";
    $result .= "<header>";
    $result .= "<a id=\"skip-link\" href=\"#main\">Skip to content</a>";
    $result .= "<h1><img src=\"./img/logo.png\" alt=\"Northern Phish and Loan\"></h1> <!-- This was a link, removed to reduce unnecessary tab stops -->";
    $result .= "<nav id=\"primary-navigation\" aria-label=\"Site Navigation\">";
    $result .= "<ul>";
    $result .= "<li><a href=\"index.php\">Home</a></li>";
    if(isLoggedIn()) {
        $result .= "<li><button id=\"online-banking-menu-button\" type=\"button\" aria-expanded=\"false\" aria-controls=\"online-banking-dropdown\" onclick=\"toggleExpandButton('online-banking-menu-button')\" keydown=\"keypressEventDisclouseButton\">Online Banking</button>";
        $result .= "<ul id=\"online-banking-dropdown\" hidden>";
        //$result .= "<li><a href=\"dashboard.php\">Dashboard</a></li>";
        $result .= "<li><a href=\"mobile-deposit.php\">Mobile deposit</a></li>";
        //$result .= "<li><a href=\"transfer.php\">Funds transfer</a></li>";
        //$result .= "<li><a href=\"new-account.php\">Open account</a></li>";
        //$result .= "<li><a href=\"profile.php\">Profile</a></li>";
        $result .= "<li><a href=\"change-password.php\">Change Password</a></li>";
        $result .= "<li><a href=\"logout.php\">Log Out</a></li>";
        $result .= "</ul>";
        $result .= "</li>";
        $result .= "<li><a href=\"feedback.php\">Feedback</a></li>";
    } else {
        $result .= "<li><a href=\"login.php\">Login</a></li>";
        $result .= "<li><a href=\"register.php\">Register</a></li>";
    }
    $result .= "<li><button id=\"about-menu-button\" type=\"button\" aria-expanded=\"false\" aria-controls=\"about-dropdown\" onclick=\"toggleExpandButton('about-menu-button')\" keydown=\"keypressEventDisclouseButton\">About</button>";
    $result .= "<ul id=\"about-dropdown\" hidden>";
    //$result .= "<li><a href=\"accounts.php\">Accounts</a></li>";
    $result .= "<li><a href=\"about.php\">About Us</a></li>";
    $result .= "<li><a href=\"legal.php\">Legal</a></li>";
    $result .= "</ul>";
    $result .= "</li>";
    $result .= "</ul>";
    $result .= "</nav>";
    $searchIcon = "<svg id=\"fsa_HeaderButtonWebSearchToggle\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z\"></path></svg>";
    $result .= "<form role=\"search\" method=\"GET\" action=\"search.php\">";
    $result .= "<input id=\"query-field\" type=\"search\" name=\"query\" required aria-labelledby=\"search-button\" title=\"Search site by keyword\" placeholder=\"Search keywords\">";
    $result .= "<button id=\"search-button\" type=\"submit\" aria-label=\"Search\">$searchIcon</button>";
    $result .= "</form>";
    $result .= "</header>";
    return $result;
}

/**
 * Generates headers, footers, and all of that good stuff. Pass it HTML to place in the &lt;main&gt; element, and it returns an entire page to be <code>echo</code>'d
 * @param string $mainContent HTML markup that will be placed inside of the &lt;main&gt; element.
 * @return string HTML string for an entire page of the site.
 */
function generatePage(string $mainContent): string {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    $result = "<!DOCTYPE html><html lang=\"en\">";
    $result .= createHeadElement();
    $result .= "<body>";
    $result .= "<!-- TODO: --><!-- Prevent users from putting JavaScript code in the search form --><!-- Figure out why SQL errors happen when a username contains a quote --><!-- Check file types that are uploaded to the site -->";
    $result .= createHeaderElement();
    $result .= "<main id=\"main\">$mainContent</main>";
    $result .= "<footer>";
    $result .= "<p>This site is for educational purposes only and does not provide financial services.</p>";
    $result .= "<p>Copyright © 2025 West Virginia Northern Community College, Department of Computer Information Technology.</p>";
    $result .= "</footer>";
    $result .= "</body>";
    $result .= "</html>";
    return $result;
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
            $statusMessage = "Invalid SQL: <samp>SELECT * FROM users WHERE username=\"<u>$username\" AND password=\"$password\"</u></samp>";
            if(str_starts_with($username, '"')) {
                $statusMessage .= "<div>Content following quote appears to be invalid.</div>";
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
function isLoggedIn() {
    return isset($_COOKIE["is-logged-in"]);
}

function login(int $userId) {
    setcookie("is-logged-in", "true");
    setcookie("logged-in-user", $userId);
}