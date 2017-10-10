<?php

require '../site.php';
use T_E\DB;

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();

$current_page = 'portfolio';

$data['images'] = DB\queryFetch('SELECT * FROM images',
					array(),
					$conn);

adminview('admin/portfolio', $data, $current_page);