<div id="upload-wrap">

	<form action="../controllers/upload-img.php" method="post" enctype="multipart/form-data">
		<div id="top">

			<?php if ( isset($status) ) : ?>
			<?php echo $status; ?>
			<?php endif; ?>

			<h2>Image upload</h2>

		</div>

		<div class="help"><p>All portfolio images must be a maximum width or height of 1000px and .jpg format, optimised for web.</p></div>

		<ul>
			<li>
				<label for="file">Image: <span>*</span></label>
				<input type="file" name="file" id="file" multiple />
			</li>
				<label for="alt_tag">'alt' tag: <span>*</span></label>
				<input type="text" name="alt_tag" id="alt_tag" value="" />
			</li>
			<li>
				<label for="img_info">Info: </label>
				<input type="text" name="img_info" id="img_info" value="" />
			</li>
			<li>
				<label for="category">Category: <span>*</span></label>
				<select name="category" id="category">
					<option value="">Select</option>
					<?php
						foreach( $categories as $category ) {
							echo "<option value='".$category['category']."'>".ucwords($category['category'])."</option>";
						}
					?>
				</select> <span>OR ENTER NEW CATEGORY</span>
				<input type="text" name="new_category" id="new_category" value="" />
			</li>
			<li>
				<label for="image_set">Image set: </label>
				<select name="image_set" id="image_set">
					<option value="">Select</option>
					<?php
						foreach( $image_sets as $img_set ) {
							$img_set_alt = str_replace('_', ' ', $img_set['image_set']);
							if ( $img_set_alt !== '' ) {
								echo "<option value='".$img_set['image_set']."'>".ucwords($img_set_alt)."</option>";
							}
						}
					?>
				</select> <span>OR ENTER NEW SET</span>
				<input type="text" name="new_set" id="new_set" value="" />
			</li>
			<li>
				<label for="img_slider">Include in slider: </label>
				<input type="checkbox" name="img_slider" id="img_slider" value="1" />
			</li>
			<li>
				<input type="submit" name="upload" id="upload" value="Upload" />
			</li>
		</ul>
	</form>

	<footer>
		<!--<progress></progress>-->
		<!--<p class="link"><a href="portfolio.php" class="link-button">Cancel</a></p>-->
	</footer>

	<div class="upload-info">
		<?php if ( isset($file_details) ) : ?>
		<?php echo $file_details; ?>
		<?php endif; ?>

		<?php if ( isset($status_details) ) : ?>
		<?php echo $status_details; ?>
		<?php endif; ?>

		<?php if ( isset($file_status) ) : ?>
		<?php echo $file_status; ?>
		<?php endif; ?>

		<?php if ( isset($thumbnail) ) : ?>
		<?php echo $thumbnail; ?>
		<?php endif; ?>
	</div>
</div>