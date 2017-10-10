<div id="create-wrap">

	<form action="" method="post" class="update">
		<div id="top">
			<h2>Create post</h2>
			
			<div class="info">
				<?php if ( isset($status) ) : ?>
				<?php echo $status; ?>
				<?php endif; ?>
			</div>

			<ul>
				<li class="right">
					<input type="submit" name="save" id="save" value="Save" disabled="disabled">
				</li>
				<li class="right" id="live-box">
					<label for="live">Live: </label>
					<input type="checkbox" name="live" id="live" value="1">
				</li>
			</ul>
		</div>
		<div id="left">
			<ul>
				<li>
					<label for="title">Title: <span>*</span></label>
					<input type="text" name="title" id="title" autofocus>
				</li>
				<li>
					<label for="standfirst">Standfirst: <span>*</span></label>
					<input type="text" name="standfirst" id="standfirst">
				</li>
				<li>
					<label for="body">Body: <span>*</span></label>
					<textarea name="body" id="body"></textarea>
				</li>
			</ul>
		</div>
		<div id="right">
			<ul>
				<li>
					<label for="post_img">Post image: </label>
					<a href="upload.php" class="lightbox-button link-button">Upload</a>
					<select name="post_img" id="post_img">
						<option value="null">Select</option>
						<?php
							foreach( $blog_imgs as $blog_img ) {
								echo "<option value='".$blog_img['img_path'].$blog_img['file_name']."'>".$blog_img['file_name']."</option>";
							}
						?>
					</select>
					<div id="post_img_display"></div>
				</li>
				<li>
					<label for="image_set">Image set: </label>
					<select name="image_set" id="image_set">
						<option value="null">Select</option>
						<?php
							foreach( $image_sets as $img_set ) {
								$img_set_alt = str_replace('_', ' ', $img_set['image_set']);
								if ( $img_set_alt !== '' ) {
									echo "<option value='".$img_set['image_set']."'>".ucwords($img_set_alt)."</option>";								
								}
							}
						?>
					</select>
				</li>
			</ul>
		</div>
	</form>
	
	<footer>
		<p class="link"><a href="blog.php" class="link-button">Cancel</a></p>
	</footer>
</div>