<div id="page-text-wrap">
	<p style="border: 1px solid #000000; display: inline; padding: 4px 6px 6px 4px; cursor: pointer;">+ Create page</p>
	<p style="border: 1px solid #000000; display: inline; padding: 4px 6px 6px 4px; cursor: pointer;">- Delete page</p>
	<p style="border: 1px solid #000000; display: inline; padding: 4px 6px 6px 4px; cursor: pointer;">+ Display on site</p>

	<form action="" method="post">
		<ul>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
					</li>
					<li>
						<label for="about"><?php echo $page_text[0]['page_name']; ?></label>
						<textarea name="about" id="about"><?php echo $page_text[0]['body']; ?></textarea>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[1]['page_name']; ?></label>
						<textarea name="purchase" id="purchase"><?php echo $page_text[1]['body']; ?></textarea>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[2]['page_name']; ?></label>
						<textarea name="purchase" id="purchase"><?php echo $page_text[2]['body']; ?></textarea>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[3]['page_name']; ?></label>
						<textarea name="purchase" id="purchase"><?php echo $page_text[3]['body']; ?></textarea>
					</li>
				</ul>
			</li>
		</ul>
	</form>
</div>