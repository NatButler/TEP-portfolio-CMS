<div id="post-wrap">

	<form action="" method="post" class="update">
		<div id="top">
			<h2>Edit post</h2>

			<div class="info">
				<?php if ( isset($status) ) : ?>
				<?php echo $status; ?>
				<?php endif; ?>
			</div>

			<ul>
				<li class="right">
					<input type="image" src="../img/icons/delete.png" name="delete" id="delete" value="delete">
					<input type="submit" name="save" id="save" value="Save" disabled="disabled">
				</li>
				<li class="right" id="live-box">
					<label for="live">Live: </label>
					<input type="checkbox" name="live" id="live" value="1" <?php if ( $post['live'] ) { echo 'checked="checked"'; } ?>>
				</li>
			</ul>
		</div>
		<div id="left">
			<ul>
				<li>
					<label for="title">Title: </label>
					<input type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
				</li>
				<li>
					<label for="standfirst">Standfirst: </label>
					<input type="text" name="standfirst" id="standfirst" value="<?php echo $post['standfirst']; ?>">
				</li>
				<li>
					<label for="body">Body: </label>
					<textarea name="body" id="body"><?php echo $post['body']; ?></textarea>
				</li>
			</ul>
		</div>
		<div id="right">
			<ul>
				<li>
					<?php if ( $post['date_created'] != $post['last_updated'] ) {
						$newDate = date( "d/m/Y", strtotime($post['last_updated']) );
						echo 'Last updated: ' . $newDate;
					} else {
						$newDate = date( "d/m/Y", strtotime($post['date_created']) );
						echo 'Date created: ' . $newDate;
					}
					?>
				</li>
				<li>Author: <?php echo $post['author']; ?></li>
				<li>
					<label for="post_img">Post image: </label>
					<a href="upload.php" class="lightbox-button link-button">Upload</a>
					<select name="post_img" id="post_img">
						<option value="null">Select</option>
						<?php
							foreach( $blog_imgs as $blog_img ) {
								if ( strpos($post['post_img'], $blog_img['file_name']) !== false ) { $selected = 'selected'; } else { $selected = ''; }
								echo "<option value='".$blog_img['img_path'].$blog_img['file_name']."'" . $selected . ">".$blog_img['file_name']."</option>";
							}
						?>
					</select>
					<div id="post_img_display"><?php if ( $post['post_img'] && $post['post_img'] !== 'null' ) { echo "<img src='../" . $post['post_img'] . "' alt='post-image' class='post-thumbnail' />"; } ?></div>
				</li>
				<li>
					<label for="image_set">Image set: </label>
					<select name="image_set" id="image_set">
						<option value="null">Select</option>
						<?php
							foreach( $image_sets as $img_set ) {
								if ( $img_set['image_set'] == $post['image_set'] ) { $select = 'selected'; } else { $select = ''; }
								$img_set_alt = str_replace('_', ' ', $img_set['image_set']);
								if ( $img_set_alt !== '' ) {
									echo "<option value='".$img_set['image_set']."'" . $select . ">".ucwords($img_set_alt)."</option>";
								}
							}
						?>
					</select>
				</li>
			</ul>
		</div>
	</form>
	
	<footer>
		<p class="link"><a href="blog.php" class="link-button">Back</a><a href="create.php" class="link-button">Create new post</a></p>
	</footer>
</div>