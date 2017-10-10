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

// Calculate new post ID
$current_id = DB\queryFetch('SELECT * FROM blog ORDER BY id DESC LIMIT 0, 1',
							array(),
							$conn)[0];

$new_id = $current_id['id'] + 1;

$data['image_sets'] = DB\queryFetch('SELECT DISTINCT image_set FROM images ORDER BY image_set ASC',
										array(), 
										$conn);

$data['blog_imgs'] = DB\queryFetch('SELECT * FROM images WHERE category = "blog"',
										array(),
										$conn);

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$title = $_POST['title'];
	$standfirst = $_POST['standfirst'];
	$body = $_POST['body'];
	$author_id = $_SESSION['user_id'];
	$post_img = $_POST['post_img'];
	$image_set = $_POST['image_set'];
	$live = isset($_POST['live']);
	$date_created = date("Y-m-d");

	if ( empty($title) || empty($standfirst) || empty($body) ) {
		$data['status'] = '<p class="status">Fields with <span>*</span> are required.</p>';
		exit;
	} else {
		DB\queryInsert(
			"INSERT INTO blog(title, standfirst, body, author_id, post_img, image_set, live, date_created, last_updated) VALUES(:title, :standfirst, :body, :author_id, :post_img, :image_set, :live, :date_created, :last_updated)",
			array('title' => $title, 'standfirst' => $standfirst, 'body' => $body, 'author_id' => $author_id, 'post_img' => $post_img, 'image_set' => $image_set, 'live' => $live, 'date_created' => $date_created, 'last_updated' => $date_created),
			$conn);

		$data['status'] = '<p class="status">Post successfully saved</p>';
		
		// Change to post view of new post
		header("location: post.php?id=$new_id");
		exit;
	}

} else {
	adminview('admin/create', $data, $current_page);
}