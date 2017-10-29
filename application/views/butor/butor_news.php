			<?php if(isset($news)): ?>
			<div class="col-lg-7 col-md-8 col-sm-8"  id="butor-news">
				<h3 class="butor-caption"><?php echo $newsTitle;?></h3>
				<div class="container-fluid">
					<?php foreach($news as $newsItem): ?>
						<p><?php echo $newsItem->news_text; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
