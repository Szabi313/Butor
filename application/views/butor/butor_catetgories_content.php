			<div class="col-lg-7 col-md-8 col-sm-8"  id="butor-products-image">
				
				<?php if(isset($result[0])):?>	
					<h3 class="butor-caption"><?php if(isset($mainTitle)) echo $mainTitle; else echo "Termékeink";?></h3>
					<div id="thumb-container" class="container-fluid">
						
						
						<div class="row">
							
							<?php foreach($result as $resultItem): ?>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="thumbnail">
										<a href="<?php echo base_url(); if($resultItem->isSubCategory)echo "alkategoriak/"; else echo "kategoria/"; echo $resultItem->name; if($resultItem->all_product) echo "/1";?>"><img src="content/images/<?php echo $resultItem->imgName;?>"></a>
										<h6><a href="<?php echo base_url(); if($resultItem->isSubCategory)echo "alkategoriak/"; else echo "kategoria/"; echo $resultItem->name; if($resultItem->all_product) echo "/1";?>"><?php echo $resultItem->title; ?></h6></a>
									</div>
								</div>
							<?php endforeach; ?>
							
						
						</div>
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
