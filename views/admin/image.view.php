<div id="image-wrap">
	<h2><?php echo $image['file_name']; ?></h2>

	<?php if ( $image['category'] === 'blog' ) {
		echo '<div class="image-display" style="background: url(../' . $image['img_path'].$image['file_name'] . ') no-repeat 50% 50%;"></div>';			
	} else {
		if ( $image['img_width'] < 1000 ) {
			echo '<div class="image-display"><img src="../'.$image['img_path'].$image['file_name'].'" alt="'.$image['alt_tag'].'" class="portfolio-img-portrait" /></div>';	
		} else {
			echo '<div class="image-display"><img src="../'.$image['img_path'].$image['file_name'].'" alt="'.$image['alt_tag'].'" class="portfolio-img" /></div>';					
		}
	}
	?>

	<form action="" method="post" class="update">
		<div id="top">
			<ul>
				<li class="right">			
					<input type="image" src="../img/icons/delete.png" name="delete" id="delete" value="delete">
					<input type="submit" name="save" id="save" value="Save" disabled="disabled">
				</li>
			</ul>
		</div>
		<ul>
			<li>
				<label>Id: </label><?php echo '<p>'.$image['id'].'</p>'; ?>
			</li>
			<li>
				<label>File name: </label><?php echo '<p>'.$image['file_name'].'</p>'; ?>
			</li>
			<li>
				<label>Image URL: </label><?php echo '<p>'.$image['img_path'].$image['file_name'].'</p>'; ?>
			</li>
			<li>
				<label>Dimentions <span>(px)</span>: </label><?php echo '<p>'.$image['img_width'] . '(w) ' . $image['img_height'].'(h)</p>'; ?>
			</li>
			<li>
				<label for="alt_tag">'alt' tag: </label>
				<input type="text" name="alt_tag" id="alt_tag" value="<?php echo $image['alt_tag']; ?>">
			</li>
			<li>
				<label for="img_info">Info: </label>
				<input type="text" name="img_info" id="img_info" value="<?php if ($image['img_info']) { echo $image['img_info']; } else { echo ''; } ?>">
			</li>
			<li>
				<label for="category">Category: </label>
				<select name="category" id="category">
					<?php
						foreach( $categories as $category ) {
							if ( $image['category'] == $category['category'] ) { $selected = 'selected'; } else { $selected = ''; }
							echo "<option value='".$category['category']."'" . $selected . ">".ucwords($category['category'])."</option>";
						}
					?>
				</select>
			</li>
			<li>
				<label for="image_set">Image set: </label>
				<select name="image_set" id="image_set">
					<option value="null">None</option>
					<?php
						foreach( $image_sets as $img_set ) {
							if ( $img_set['image_set'] == $image['image_set'] ) { $select = 'selected'; } else { $select = ''; }
							$img_set_alt = str_replace('_', ' ', $img_set['image_set']);
							if ( $img_set_alt !== '' ) {
								echo "<option value='".$img_set['image_set']."'" . $select . ">".ucwords($img_set_alt)."</option>";
							}
						}
					?>
				</select>
			</li>
			<li>
				<label for="img_slider">Include in slider: </label>
				<input type="checkbox" name="img_slider" id="img_slider" value="1" <?php if ( $image['img_slider'] ) { echo 'checked="checked"'; } ?>>
			</li>
		</ul>
	</form>

	<div class="info">
		<?php if ( isset($status) ) : ?>
		<?php echo $status; ?>
		<?php endif; ?>
	</div>

	<footer>
		<p class="link"><a href="portfolio.php" class="link-button">Back</a></p>
	</footer>

</div>