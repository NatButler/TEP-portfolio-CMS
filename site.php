<?php

require 'functions.php';
require 'db.php';

// CONNECT TO DB
$conn = T_E\DB\connect($config);
if ( !$conn ) die('Problem connecting to the DB.');