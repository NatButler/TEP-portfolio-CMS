<?php

require '../site.php';

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();

$current_page = 'contact';

adminview('admin/contact', $data, $current_page);