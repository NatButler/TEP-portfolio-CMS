<?php

require '../site.php';
use T_E\DB;

$table = $_POST['table'];
$id = $_POST['id'];
$check = $_POST['checkbox'];

if ( $table === 'images' ) {
	DB\queryInsert(
		"UPDATE images SET img_slider = :img_slider WHERE id = :id",
		array('img_slider' => $check, 'id' => $id),
		$conn);
} 
elseif ( $table === 'blog' ) {
	DB\queryInsert(
		"UPDATE blog SET live = :live WHERE id = :id",
		array('live' => $check, 'id' => $id),
		$conn);
}