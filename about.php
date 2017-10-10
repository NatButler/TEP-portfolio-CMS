<?php

require 'site.php';
use T_E\DB;

$data = array();

// FETCH NAVIGATION
$data['categories'] = DB\queryFetch('SELECT DISTINCT category FROM images ORDER BY category ASC',
										array(), 
										$conn);

$data['navigation'] = DB\queryFetch('SELECT DISTINCT category, image_set FROM images ORDER BY category ASC',
										array(),
										$conn);

$data['pages'] = DB\queryFetch('SELECT page_name FROM page_text ORDER BY page_name ASC',
										array(),
										$conn);


view('about', $data);