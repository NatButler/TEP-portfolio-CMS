<?php

require '../site.php';
use T_E\DB;

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();
$imageId = (INT)$_GET['id'];

$current_page = 'portfolio';

$image = DB\get_by_id('images', $imageId, $conn);

$data['categories'] = DB\queryFetch('SELECT DISTINCT category FROM images ORDER BY category ASC',
										array(), 
										$conn);

$data['image_sets'] = DB\queryFetch('SELECT DISTINCT image_set FROM images ORDER BY image_set ASC',
										array(), 
										$conn);

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	if ( isset($_POST['save']) ) {
		$alt_tag = $_POST['alt_tag'];
		$category = $_POST['category'];
		if ( $category === 'blog' ) {
			$image_set = '';
		} else {
			$image_set = $_POST['image_set'];
		}
		$img_info = $_POST['img_info'];
		$img_slider = isset($_POST['img_slider']);

		DB\queryInsert(
			"UPDATE images SET alt_tag = :alt_tag, category = :category, image_set = :image_set, img_info = :img_info, img_slider = :img_slider WHERE id = :id",
			array('alt_tag' => $alt_tag, 'category' => $category, 'image_set' => $image_set, 'img_info' => $img_info, 'img_slider' => $img_slider, 'id' => $imageId),
			$conn);

		$data['status'] = '<p class="status">Update successfully saved.</p>';

		header("location: image.php?id=$imageId");
		exit;
	} 
	else //elseif ( isset($_POST['delete']) ) //( $_POST['delete'] ) 
	{

		if ( $image['category'] === 'blog' && is_readable('../'.$image['img_path'].$image['file_name']) ) {
			unlink('../'.$image['img_path'].$image['file_name']);
		} 
		else if ( $image['category'] !== 'blog' && is_readable('../'.$image['img_path'].$image['file_name']) ) {
			
			// DELETE ACTUAL IMAGE FILE
			unlink('../'.$image['img_path'].$image['file_name']);

			// CHECK FOR THUMBNAIL AND DELETE
			if ( is_readable('../'.$image['img_path'].'thumbs/'.$image['file_name']) ) {
				unlink('../'.$image['img_path'].'thumbs/'.$image['file_name']);
			}

			// DELETE FROM DATABASE
			DB\queryInsert(
				"DELETE FROM images WHERE id = :id",
				array('id' => $imageId),
				$conn);

			$data['status'] = '<p class="status">Image successfully deleted.</p>';

			header('location: portfolio.php');
			exit;

		} else {
			$data['status'] = '<p class="status">It was not possible to delete the image.</p>';
		}


	}

}

if ( $image ) {

	$data['image'] = $image;

	adminview('admin/image', $data, $current_page);
} else {
	header('location:/');
}