<!-- DataTables Initialisation -->
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#posts_table').dataTable({
            "bAutoWidth": true,
            "aaSorting": [[1,'desc']],
            "iDisplayLength": 25,
            "aoColumns": [
                { "sType": "numeric", "bSortable": false },
                { "sType": "string", "asSorting": ["desc", "asc"] },
                { "sType": "string", "asSorting": ["desc", "asc"] },
                { "sType": "string" },
                { "sType": "string" },
                { "sType": "html", "bSortable": false }
            ]
        });
    });
})(jQuery);
</script>

<div id="blog-wrap">
	<div class="nav"><a href="create.php" class="link-button">+ Create new post</a></div>
	<div class="help"><p>Click a post title to view or update.</p></div>

	<table id="posts_table">
		<thead>
			<tr><th>Id</th><th>Date created</th><th>Last updated</th><th>Title</th><th>Author</th><th>Live</th></tr>
		</thead>
		<tbody>
		<?php foreach($posts as $post) : ?>
			<tr>
				<td>
					<?php echo $post['id']; ?>
				</td>
				<td>
					<?php
						echo '<!--'.str_replace('-', '', $post['date_created']).'-->'; // To allow datatables sorting
						$newDate = date("d/m/Y", strtotime($post['date_created'])); echo $newDate; 
					?>
				</td>
				<td>
					<?php 
						echo '<!--'.str_replace('-', '', $post['last_updated']).'-->'; // To allow datatables sorting
						$newUpdateDate = date("d/m/Y", strtotime($post['last_updated'])); echo $newUpdateDate; 
					?>
				</td>
				<td>
					<a href="post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a>
				</td>
				<td>
					<?php echo $post['username']; ?>
				</td>
				<td> <!-- <?php //if ( $post['live'] ) { echo 'class="yes"'; } else { echo 'class="no"'; } ?> -->
					<input type="checkbox" name="<?php echo $post['id'] ?>" id="post-id-<?php echo $post['id'] ?>" class="datatableCheckbox" value="1" <?php if ( $post['live'] ) { echo 'checked="checked"'; } ?> >
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>

</div>