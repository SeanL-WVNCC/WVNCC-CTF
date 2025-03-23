<?php
/*
    logout.php
    Visiting this page will instantly log you out.
*/
session_start();
include "include/functions.php";

logout();
header("Location: /");