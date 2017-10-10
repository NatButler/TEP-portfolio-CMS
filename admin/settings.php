<?php

require '../site.php';

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();

$current_page = 'settings';

adminview('admin/settings', $data, $current_page);