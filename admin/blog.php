<?php

require '../site.php';
use T_E\DB;

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();

$current_page = 'blog';

$data['posts'] = DB\queryFetch('SELECT blog.id, date_created, last_updated, title, standfirst, live, username FROM blog INNER JOIN users ON users.id = blog.author_id',
	array(), $conn);

adminview('admin/blog', $data, $current_page);