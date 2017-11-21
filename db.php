<?php namespace T_E\DB;

require 'config.php';


function connect($config)
{
	try {
		$conn = new \PDO('mysql:host=127.0.0.1;dbname=' . $config['DB_DATABASE'],
																											$config['DB_USERNAME'],
																											$config['DB_PASSWORD']);
		
		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function queryFetch($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);
	$stmt->setFetchMode(\PDO::FETCH_ASSOC);

	return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : false;
}

function queryInsert($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	return ($stmt->rowCount() > 0) ? $stmt : false;
}

function get($tableName, $conn, $limit = 10)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName ORDER BY date_created DESC LIMIT $limit");

		return ( $result->rowCount() > 0 )
		? $result
		: false;
	} catch (Exception $e) {
		return false;
	}
}

function get_by_id($tableName, $id, $conn)
{
	$query = queryFetch(
		"SELECT * FROM $tableName WHERE id = :id LIMIT 1",
		array('id' => $id),
		$conn
	)[0];

	if ( $query ) {
		return $query;
	} else {
		// DO SOMETHING ELSE
	}
}

function get_user_cred($tableName, $post_username, $conn)
{
	$query = queryFetch(
		"SELECT * FROM $tableName WHERE username = :username LIMIT 1",
		array('username' => $post_username),
		$conn
	)[0];
	
	if ( $query ) {
		return $query;
	} else {
		// DO SOMETHING ELSE
	}			
}

?>