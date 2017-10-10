<div id="aside" class="initial">
	<div id="aside-tab">
		<!-- <img src="img/icons/thumbnails-tab_02.png" width="16px" height="16px" style="position: absolute; top: 3px; left: 3px;" /> -->
	</div>
	<div id="thumbnails"></div>
</div>

<div id="main-content">
	<!-- <div id="location"></div> -->
	<div id="display">
		<div class="slider">
			<ul>
				<?php foreach($sliderImgs as $sliderImg) : ?>
					<li>
						<img <?php echo 'src="' . $sliderImg['img_path'] . $sliderImg['file_name'] . '" alt="' . $sliderImg['alt_tag'] . '"' ?>  width="550" />
					</li>
				<?php endforeach ?>
			</ul>
		</div>
		<div id="slide-nums"></div>
		<div id="prev" class="button" data-dir="prev"></div>
		<div id="next" class="button" data-dir="next"></div>
		
		<div id="enter">ENTER</div>
	</div>
</div>