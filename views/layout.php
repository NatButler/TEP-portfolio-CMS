<!DOCTYPE HTML>

<html lang="en">

<head>
	<meta charset="UTF-8">

	<!-- www.phpied.com/conditional-comments-block-download/ -->
	<!--[if IE]><![endif]-->
	<script>document.documentElement.className = 'js';</script>
	<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="../js/selectivizr-min.js"></script>
	<![endif]-->

	<title>Jeremy Butler Photography</title>
	<link href="img/icons/favicon.ico" rel="icon">

</head>
<body>
	<div id="header">
		<h1>Jeremy Butler <span>Photography</span></h1>
		<nav id="secondary">
			<ul>
				<?php 
					foreach($categories as $cat) {
						if ( $cat['category'] !== 'blog' ) {
							echo '<li><h4>'.$cat['category'].'</h4><ul>';
						
							foreach($navigation as $nav) {
								if ( $nav['category'] === $cat['category'] ) {
									$img_set = str_replace('_', ' ', $nav['image_set']);
									echo '<li><a href="#" class="image-set">'.$img_set.'</a></li>';
								}
							}
							echo '</ul></li>';
						}
					}
				?>
			</ul>
		</nav>
		<nav id="main">
			<ul>
				<?php
					foreach($pages as $page) {
						echo '<li><h4><a href="#">'.$page['page_name'].'</a></h4></li>';
					}
				?>
			</ul>
		</nav>
	</div>
	<div id="container">
		<?php include ($path); ?>
		<div id="lightbox">
    		<div id="lightbox-window"></div>
		</div>
	</div>

<script src="js/libs/jQuery_1.10.2.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>