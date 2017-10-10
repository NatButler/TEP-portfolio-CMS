<?php

require '../site.php';

session_start();

session_destroy();
$_SESSION = array();
//delete cookie
header('location: login.php');