<?php
/*
    logout.php
    Visiting this page will instantly log you out.
    FIXME: The HTTP spec requires GET requests to be stateless,
    this should really be a POST endpoint.
*/
session_start();
include "/var/www/html/include/functions.php";

logout();
header("Location: /");