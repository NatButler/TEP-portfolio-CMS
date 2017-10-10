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

// FETCH SLIDER IMGS
$data['sliderImgs'] = DB\queryFetch('SELECT * FROM images WHERE img_slider = :imgSlider',
						array('imgSlider' => true),
						$conn);

if ( isXHR() && isset($_POST['image_set']) ) {
	$images = DB\queryFetch('SELECT * FROM images WHERE image_set = :image_set',
			array('image_set' => $_POST['image_set']),
			$conn);

	echo json_encode($images);
	return;
}

if ( isset ($_POST['image_set']) ) {
	$images = DB\queryFetch('SELECT * FROM images WHERE image_set = :image_set',
			array('image_set' => $_POST['image_set']),
			$conn);
}

view('index', $data);