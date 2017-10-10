<?php

function isXHR() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH'] );
}

function is_logged_in() 
{
	return isset($_SESSION['username']);
}

function validate_user_creds($actual_pass, $post_password) 
{
	// Check database at this point to validate credentials
	return (password_verify($post_password, $actual_pass));
}

function view($path, $data = null, $current_page = null)
{
	if ( $data ) {
		extract($data);
	}

	$path = $path . '.view.php';

	include "views/layout.php";
}

function adminview($path, $data = null, $current_page = null)
{
	if ( $data ) {
		extract($data);
	}

	$path = $path . '.view.php';

	include "views/admin.layout.php";
}

function adminWindowView($path, $data = null, $current_page = null)
{
	if ( $data ) {
		extract($data);
	}

	$path = $path . '.view.php';

	include "views/$path";
}

function createThumbnail($file_name, $img_path) {
	$im = imagecreatefromjpeg('../' . $img_path . $file_name);

	$thumbs_dir = '../' . $img_path . 'thumbs/';

	$ox = imagesx($im);
	$oy = imagesy($im);

	$nx = 185;
	$ny = floor($oy * ($nx / $ox));

	$nm = imagecreatetruecolor($nx, $ny);

	//imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);
	imagecopyresampled($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);

	if ( !file_exists($thumbs_dir) ) {
		if ( mkdir($thumbs_dir, 0777, true) ) {
			imagejpeg($nm, $thumbs_dir . $file_name);

			return '<img src="' . $thumbs_dir . $file_name . '" alt="uploaded-thumb" class="uploaded-thumb" />';
		}
		else {
			die('There was a problem');
		}
	}
	else {
		imagejpeg($nm, $thumbs_dir . $file_name);

		return '<img src="' . $thumbs_dir . $file_name . '" alt="uploaded-thumb" class="uploaded-thumb" />';
	}
}
?>