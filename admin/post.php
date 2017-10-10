<?php

require '../site.php';
use T_E\DB;

session_start();

if ( !is_logged_in() ) {
	header('location: login.php');
	die();
}

$data = array();
$postId = (INT)$_GET['id'];

$current_page = 'blog';

$post = DB\queryFetch('SELECT users.username AS author, title, standfirst, body, date_created, last_updated, post_img, image_set, live FROM blog INNER JOIN users ON users.id = blog.author_id WHERE blog.id = :id',
	array('id' => $postId), $conn)[0];

$data['image_sets'] = DB\queryFetch('SELECT DISTINCT image_set FROM images ORDER BY image_set ASC',
										array(), 
										$conn);

$data['blog_imgs'] = DB\queryFetch('SELECT * FROM images WHERE category = "blog"',
										array(),
										$conn);

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	if ( isset($_POST['save']) ) {
		$title = $_POST['title'];
		$standfirst = $_POST['standfirst'];
		$body = $_POST['body'];
		$post_img = $_POST['post_img'];
		$image_set = $_POST['image_set'];
		$live = isset($_POST['live']);
		$last_updated = date("Y-m-d");

		if ( empty($title) || empty($standfirst) || empty($body) ) {
			$data['status'] = '<p class="status">Fields with <span>*</span> are required.</p>';
		} else {
			DB\queryInsert(
				"UPDATE blog SET title = :title, standfirst = :standfirst, body = :body, post_img = :post_img, image_set = :image_set, live = :live, last_updated = :last_updated WHERE id = :id",
				array('title' => $title, 'standfirst' => $standfirst, 'body' => $body, 'post_img' => $post_img, 'image_set' => $image_set, 'live' => $live, 'last_updated' => $last_updated, 'id' => $postId),
				$conn);

			// Reload with changes
			header("location: post.php?id=$postId");
			$data['status'] = '<p class="status">Post successfully saved</p>';
			exit;
		}
	} 
	else //( $_POST['delete'] ) 
	{
		DB\queryInsert(
			"DELETE FROM blog WHERE id = :id",
			array('id' => $postId),
			$conn);

		$data['status'] = '<p class="status">Post successfully deleted</p>';

		// Redirect to blog
		header("location: blog.php");
		exit;
	}

}

if ( $post ) {

	$data['post'] = $post;

	adminview('admin/post', $data, $current_page);
} else {
	header('location:/');
}