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
        $this->isAdmin;
    }
}