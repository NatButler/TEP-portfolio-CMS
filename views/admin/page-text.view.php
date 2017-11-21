<div id="page-text-wrap">
	<button class="function-button">+ Create page</button>
	<button class="function-button">- Delete page</button>
	<button class="function-button">+ Make live</button>
	<button class="function-button">- Hide page</button>

	<ul>
		<li><?php echo $page_text[0]['page_name']; ?></li>
		<li><?php echo $page_text[1]['page_name']; ?></li>
		<li><?php echo $page_text[2]['page_name']; ?></li>
		<li><?php echo $page_text[3]['page_name']; ?></li>
		<li><?php echo $page_text[4]['page_name']; ?></li>
	</ul>

	<form action="" method="post">
		<ul>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
						<input type="submit" name="edit" id="edit" value="Edit">
					</li>
					<li>
						<label for="about"><?php echo $page_text[0]['page_name']; ?></label>
						<textarea name="blog" id="blog"><?php echo $page_text[0]['body']; ?></textarea>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
						<input type="submit" name="edit" id="edit" value="Edit">
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
						<input type="submit" name="edit" id="edit" value="Edit">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[2]['page_name']; ?></label>
						<textarea name="basket" id="basket"><?php echo $page_text[2]['body']; ?></textarea>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
						<input type="submit" name="edit" id="edit" value="Edit">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[3]['page_name']; ?></label>
						<textarea name="about" id="about"><?php echo $page_text[3]['body']; ?></textarea>
					</li>
				</ul>
			</li>			
			<li>
				<ul>
					<li>
						<input type="submit" name="save" id="save" value="Save">
						<input type="submit" name="edit" id="edit" value="Edit">
					</li>
					<li>
						<label for="purchase"><?php echo $page_text[4]['page_name']; ?></label>
						<textarea name="about" id="about"><?php echo $page_text[4]['body']; ?></textarea>
					</li>
				</ul>
			</li>
		</ul>
	</form>
</div>