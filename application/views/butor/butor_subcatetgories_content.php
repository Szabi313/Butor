			<div class="col-lg-7 col-md-8 col-sm-8">
				
				<?php if(isset($result[0])):?>	
					
					<h3 class="butor-caption"><?php echo $result[0]->title; ?></h3>
					<div class="container-fluid" id="subcategory-container">
						
						<!-- <p class="text-center"><strong></strong><br>
							<a href=""></a><br>
							<a href=""></a><br>
						</p> -->
						
						<div class="row">
						
						<?php foreach($result as $resultItem): ?>
						
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="thumbnail">
									<a href="<?php echo base_url(); echo $link.$category."/"; echo $resultItem->name; echo "/".$resultItem->id?>"><img src="<?php echo base_url();?>content/images/<?php echo $resultItem->img;?>"></a>
									<h4><a href="<?php echo base_url(); echo $link.$category."/"; echo $resultItem->name; echo "/".$resultItem->id?>"><?php echo $resultItem->subcategoryTitle; ?></h4></a>
								</div>
							</div>
						
						<?php endforeach; ?>	
						
						</div>
						
						<p class="text-center">
							<?php 
									if(isset($result[0]->CaText))echo $result[0]->CaText;
									else	if(isset( $result[0]->PrText))echo $result[0]->PrText;
									else	if(isset( $result[0]->text))echo $result[0]->text;
						?>
						</p>
						
						
					</div>
					
				<?php else:?>
				
					<h3 class="butor-caption">Hiba</h3>
					<div class="container-fluid" id="subcategory-container">
						
						
						
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="thumbnail">
									<h4>Nincs megjeleníthető elem ebben az alkategoriában</h4>
								</div>
							</div>
						</div>
						
						
						
						
					</div>
				
				<?php endif;?>
				
			</div>
