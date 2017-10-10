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

$data['categories'] = DB\queryFetch('SELECT DISTINCT category FROM images ORDER BY category ASC',
										array(), 
										$conn);

$data['image_sets'] = DB\queryFetch('SELECT DISTINCT image_set FROM images ORDER BY image_set ASC',
										array(), 
										$conn);

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

	$allowedExts = array("jpeg", "jpg");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	$file_name = $_FILES['file']['name'];
	$alt_tag = $_POST['alt_tag'];

	if ( isset($_POST['new_category']) ) {
		$category = $_POST['new_category'];
		// replace whitespace with '_'
	} else {
		$category = $_POST['category'];		
	}

	if ( isset($_POST['new_set']) ) {
		$image_set = $_POST['new_set'];
		// replace whitespace with '_'
	} else if ( $category === 'blog' ) {
		$image_set = '';
	} else {
		$image_set = $_POST['image_set'];
	}

	$img_info = $_POST['img_info'];
	$img_slider = isset($_POST['img_slider']);

	if ( $category === 'blog' ) {
		$img_path = 'img/blog/';
	} else {
		$img_path = 'img/portfolio/' . $category . '/' . $image_set . '/';
	}

	if ( empty($file_name) || empty($alt_tag) || empty($category) ) {
			$data['status'] = '<p class="status">Fields with <span>*</span> are required.</p>';
	} else {
		if ( (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg"))
														&& ($_FILES["file"]["size"] < 1024000)
														&& in_array($extension, $allowedExts) )	{
			if ( $_FILES["file"]["error"] > 0 ) {
				$data['file_status'] = '<p class="file-status">Return Code: ' . $_FILES["file"]["error"] . '</p>';
				$data['file-details'] = '';
			}
			else {
				if ( file_exists('../' . $img_path . $file_name) ) {
					$data['status'] = '<p class="status">' . $file_name . ' already exists.</p>';
				} 
				else {			
				
					if ( !file_exists('../' . $img_path) ) {

      					if ( !mkdir('../' . $img_path, 0777, true) ) {
           					die("There was a problem. Please try again!");
      					}

      					mkdir('../' . $img_path, 0777, true);

      					// Do check and reject if image size is > 1000
						list($img_width, $img_height) = getimagesize($_FILES["file"]["tmp_name"]);

       					move_uploaded_file( $_FILES["file"]["tmp_name"], '../' . $img_path . $file_name );
						$data['file_status'] = '<p class="file-status">Stored in: ' . $img_path . $file_name . '</p>';

						if ( $category !== 'blog' ) {
							$data['thumbnail'] = createThumbnail($file_name, $img_path);
						}

						$data['file_details'] = '<p class="file-details">Upload: ' . $file_name . '<br />' .
												'Type: ' . $_FILES["file"]["type"] . '<br />' .
												'Size: ' . ($_FILES["file"]["size"] / 1024) . ' kB<br />' .
												'Temp file: ' . $_FILES["file"]["tmp_name"] . '<br /></p>';	

						DB\queryInsert(
							"INSERT INTO images(file_name, alt_tag, img_path, category, image_set, img_info, img_width, img_height, img_slider) VALUES(:file_name, :alt_tag, :img_path, :category, :image_set, :img_info, :img_width, :img_height, :img_slider)",
							array('file_name' => $file_name, 'alt_tag' => $alt_tag, 'img_path' => $img_path, 'category' => $category, 'image_set' => $image_set, 'img_info' => $img_info, 'img_width' => $img_width, 'img_height' => $img_height, 'img_slider' => $img_slider),
							$conn);

						$data['status'] = '<p class="status">Image successfully uploaded</p>';
      				}
   					else {
      					// Do check and reject if image size is > 1000
						list($img_width, $img_height) = getimagesize($_FILES["file"]["tmp_name"]);

       					move_uploaded_file( $_FILES["file"]["tmp_name"], '../' . $img_path . $file_name );
						$data['file_status'] = '<p class="file-status">Stored in: ' . $img_path . $file_name . '</p>';

						if ( $category !== 'blog' ) {
							$data['thumbnail'] = createThumbnail($file_name, $img_path);
						}

						$data['file_details'] = '<p class="file-details">Upload: ' . $file_name . '<br />' .
												'Type: ' . $_FILES["file"]["type"] . '<br />' .
												'Size: ' . ($_FILES["file"]["size"] / 1024) . ' kB<br />' .
												'Temp file: ' . $_FILES["file"]["tmp_name"] . '<br /></p>';

						DB\queryInsert(
							"INSERT INTO images(file_name, alt_tag, img_path, category, image_set, img_info, img_width, img_height, img_slider) VALUES(:file_name, :alt_tag, :img_path, :category, :image_set, :img_info, :img_width, :img_height, :img_slider)",
							array('file_name' => $file_name, 'alt_tag' => $alt_tag, 'img_path' => $img_path, 'category' => $category, 'image_set' => $image_set, 'img_info' => $img_info, 'img_width' => $img_width, 'img_height' => $img_height, 'img_slider' => $img_slider),
							$conn);

						$data['status'] = '<p class="status">Image successfully uploaded</p>';
   					}
   					header('Location: portfolio.php');
				}
			}
		}
		else {
			$data['file_status'] = '<p class="file-status">Invalid file</p>';
		}
	}
}

adminWindowView('admin/upload', $data, $current_page);