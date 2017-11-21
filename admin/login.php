<?php

require '../site.php';
use T_E\DB;

session_start();

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
	// get their values
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$login_datetime = date("Y-m-d H:i:s");

	$credentials = DB\get_user_cred('users', $username, $conn);

	if ( validate_user_creds( $credentials['password'], $password ) ) {
		$_SESSION['username'] = $credentials['username'];
		$_SESSION['user_id'] = (INT)$credentials['id'];
		$_SESSION['last_login'] = $credentials['last_login'];

		DB\queryInsert(
				"UPDATE users SET last_login = :last_login WHERE id = :id",
				array('last_login' => $login_datetime, 'id' => (INT)$credentials['id']),
				$conn);

		header('location: settings.php');
	} else {
		$status = "Incorrect username or password";
	}
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!-- www.phpied.com/conditional-comments-block-download/ -->
	<!--[if IE]><![endif]-->
	<script>document.documentElement.className = 'js';</script>
	<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-styles.css">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="../js/selectivizr-min.js"></script>
	<![endif]-->

	<title>ADMIN: Jeremy Butler Photography</title>
	<link href="../../img/icons/favicon.ico" rel="icon">

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
	<!-- <script src="../js/jQuery_1.10.2.js"></script> -->

</head>
<body>

	<div id="login-container">
		<h1>Jeremy Butler Photography</h1>
		<form action="login.php" method="post">
			<ul>
				<li>
					<label for="username">Username: </label>
					<input type="text" name="username" id="username" autofocus>
				</li>
				<li>
					<label for="password">Password: </label>
					<input type="password" name="password" id="password">
				</li>
				<li>
					<input type="submit" value="Login">
				</li>
			</ul>
			<div class="checkbox">
				<label for="remember-me">
					<input type="checkbox" name="remember-me" id="remember-me" value="remember-me"> Remember me
				</label>
			</div>
		</form>
		<p style="margin-top: 10px;"><a href="#">Forgotten password?</a></p>
			<?php if ( isset($status) ) : ?>
				<p style="color: red"><?php echo $status; ?></p>
			<?php endif; ?>
	</div>
</body>
</html>