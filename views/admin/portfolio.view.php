<!-- DataTables Initialisation -->
<script type="text/javascript">
(function($) {
    $(document).ready(function(){

    	var tableHeight = ( $(window).height() ) - ( $('#portfolio-wrap header').height() + 115 );
    	var tableH = tableHeight.toString();

        $('#images_table').dataTable({
            "bAutoWidth": true,
            "sScrollY": tableH,
            "iDisplayLength": 50,
            "aoColumns": [
                { "sType": "numeric", "asSorting": ["asc", "desc"] },
                { "sType": "html", "bSortable": false },
                { "sType": "string" },
                { "sType": "string" },
                { "sType": "string" },
                { "sType": "string" },
                { "sType": "html", "bSortable": false }
            ]
        });
    });
})(jQuery);
</script>

<div id="portfolio-wrap">
	<header>
		<div class="nav"><a href="upload.php" class="lightbox-button link-button">Upload image</a></div>
		<div class="help"><p>Click thumbnail to view or file name to update.</p></div>
	</header>

	<table id="images_table">
		<thead>
			<tr><th>Id</th><th>Thumb</th><th>File name</th><th>Alt tag</th><th>Category</th><th>Image set</th><th>Img slider</th></tr>
		</thead>
		<tbody>
		<?php foreach($images as $image) : ?>
			<?php if ( $image['category'] === 'blog' ) {
				$thumbs = "";
			} else {
				$thumbs = "thumbs/";
			} ?>
			<tr>
				<td>
					<?php echo $image['id']; ?>
				</td>
				<td>
					<?php echo '<a href="../'.$image['img_path'].$image['file_name'].'" class="lightbox-button"><img src="../'.$image['img_path'].$thumbs.$image['file_name'].'" alt="'.$image['alt_tag'].'" class="thumbnail" /></a>'; ?>
				</td>
				<td>
					<a href="image.php?id=<?php echo $image['id']; ?>"><?php echo $image['file_name']; ?></a>
				</td>
				<td>
					<?php echo $image['alt_tag']; ?>
				</td>
				<td>
					<?php echo $image['category']; ?>
				</td>
				<td>
					<?php echo $image['image_set']; ?>
				</td>
				<td> <!-- For inside td tag <?php //if ( $image['img_slider'] ) { echo 'class="yes"'; } else { echo 'class="no"'; } ?> -->
					<input type="checkbox" name="<?php echo $image['id'] ?>" id="img-id-<?php echo $image['id'] ?>" class="datatableCheckbox" value="1" <?php if ( $image['img_width'] < $image['img_height'] || $image['category'] == 'blog' ) { echo 'disabled="disabled"'; } elseif ( $image['img_slider'] ) { echo 'checked="checked"'; } ?> >
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>

</div>