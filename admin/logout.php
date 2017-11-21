<?php

require '../site.php';

session_destroy();

$_SESSION = array();
//delete cookie
header('location: login.php');