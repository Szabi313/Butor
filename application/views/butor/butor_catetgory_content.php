			<div class="col-lg-7 col-md-8 col-sm-8"  id="butor-products-image">
				
				<?php if(isset($product_result[0][0])):?>	
				
					<h3 class="butor-caption"><?php if(isset($product_result[0][0]->CaMainTitle)) echo $product_result[0][0]->CaMainTitle; elseif (isset($product_result[0][0]->CaTitle)) echo $product_result[0][0]->CaTitle; else echo "Termékkategória";?></h3>
					<div id="thumb-container" class="container-fluid">
					
					
					
					<?php if((isset($product_result[0][0]->smallPrImg) || isset($product_result[0][0]->CaTopText) || isset($product_result[0][0]->CaText)) && ($product_result[0][0]->smallPrImg || $product_result[0][0]->CaTopText || $product_result[0][0]->CaText)): ?>
					
						<?php foreach($product_result as $product_result_item): ?>
							<div class="row">
								
								<h4 class="subcategory-title"><?php if(isset($product_result_item[0]->CaMainTitle)) echo $product_result_item[0]->CaTitle; ?></h4>
								
								<?php if(isset($product_result_item[0]->CaTopText) && $product_result_item[0]->CaTopText ) : ?>
								<div id="top-text">
								<p class="text-center">
									<?php echo $product_result_item[0]->CaTopText;?>
								</p>
								</div>
								<?php endif; ?>
								
								
								<?php if(isset($product_result_item[0]->smallPrImg) && $product_result_item[0]->smallPrImg): ?>
									<?php foreach($product_result_item as $resultItem): ?>
										<?php if(isset($resultItem->sep) && $resultItem->sep): ?>
												</div>
												<div class="row">
													<p style="margin-left:12px"><?php echo $resultItem->sep ?></p>
												</div>
												<div class="row">
										<?php endif; ?>
										<div class="col-lg-4 col-md-4 col-sm-6">
											<div class="thumbnail">
												<a href="<?php echo base_url(); if(isset($resultItem->isPV) && $resultItem->isPV) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $resultItem->name; echo "/".$resultItem->id;?>"><img src="<?php echo base_url();?>content/images/<?php echo $resultItem->smallPrImg;?>"></a>
												<h6><a href="<?php echo base_url(); if(isset($resultItem->isPV) && $resultItem->isPV) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $resultItem->name; echo "/".$resultItem->id;?>"><?php echo $resultItem->title; ?></h6></a>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>	
							
							</div>
							
							
							<?php if($product_result_item[0]->CaText): ?>	
							<p class="text-center">
								<?php echo $product_result_item[0]->CaText;?>
							</p>
							<?php endif; ?>
							
						<?php endforeach; ?>
					
					<?php endif; ?>
					
					
					

					
					<?php if(isset($result) && $result[0]->text): ?>	
					<br><br>
					<p class="text-center">
						<?php echo $result[0]->text;?>
					</p>
					<?php endif; ?>
							
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
