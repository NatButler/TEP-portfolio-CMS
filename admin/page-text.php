<?php

require '../site.php';
use T_E\DB;

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();

$current_page = 'page-text';

$data['page_text'] = DB\queryFetch('SELECT * FROM page_text',
								array(),
								$conn);

adminview('admin/page-text', $data, $current_page);