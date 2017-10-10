<!DOCTYPE HTML>

<html lang="en">

<head>
	<meta charset="UTF-8">

	<!-- www.phpied.com/conditional-comments-block-download/ -->
	<!--[if IE]><![endif]-->
	<script>document.documentElement.className = 'js';</script>
	<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">

	<!-- DataTables CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/dataTables_main.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.css">

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
	<script src="../js/libs/jQuery_1.10.2.js"></script>

	<!-- DataTables -->
	<!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script> -->
	<script src="../js/libs/dataTables_1-4-9.js"></script>

</head>
<body>
	<div id="admin-container">
		<aside>
			<header id="header">
				<h1>Jeremy Butler <span>Photography</span></h1>
				<?php 	$login_date = date( 'd/m/Y g:i a', strtotime($_SESSION['last_login']) ); 
						echo '<h5>User: '.$_SESSION['username'].'</h5><h5>Last logged in: '.$login_date.'</h5>'; ?>
			</header>

			<nav>
				<ul>
					<li>
				       	<a href="settings.php" <?php if ($current_page === 'settings') { echo 'class="current"'; } ?> >
				            <span>Settings</span>
				        </a>
				    </li>
				    <li>
				        <a href="blog.php" <?php if ($current_page === 'blog') { echo 'class="current"'; } ?> >
				            <span>Blog</span>
				        </a>
				    </li>				    
				    <li>
				        <a href="portfolio.php" <?php if ($current_page === 'portfolio') { echo 'class="current"'; } ?> >
				            <span>Image library</span>
				        </a>
				    </li>
				    <li>
				    	<a href="page-text.php" <?php if ($current_page === 'page-text') { echo 'class="current"'; } ?> >
				    		<span>Page text</span>
				    	</a>
				    </li>
				    <li>
				    	<a id="logout" href="logout.php" <?php if ($current_page === 'logout') {echo 'class="current"'; } ?> >
				    		<span>Logout</span>
				    	</a>
				    </li>
				</ul>
			</nav>
		</aside>

		<div id="content">
			<div id="content-wrap">
				<?php include ($path); ?>
			</div>
		</div>
	</div>

	<div id="lightbox">
    	<div id="lightbox-window"></div>
	</div>


<script src="../js/admin-scripts.js"></script>
<script src="../js/lightbox.js"></script>

</body>
</html>