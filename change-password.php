<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_COOKIE["is-logged-in"])){
        $conn = mysqli_connect("db", "root", "hackme", "breakTheBank");
        $password = $_POST["password"];
        $username = $_SESSION["logged-in-user"];
        $query = "UPDATE users SET password=\"$password\" WHERE username=\"$username\"";
        $conn->query($query);
        header("Location: /about.php");
    } else {
        header("Location: /about.php");
    }
}
?>