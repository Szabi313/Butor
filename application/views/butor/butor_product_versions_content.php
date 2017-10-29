			<div class="col-lg-8 col-md-9 col-sm-9">
				
				<?php if(isset($result[0])):?>	
					
					<h3 class="butor-caption" id="productTitle"><?php echo $result[0]->title; ?></h3>
					<div class="container-fluid" >
					
						<br>
						<p class="text-center">
							<?php if(isset($prev)): ?>
								<a class="prev_button" href="<?php echo base_url(); if(isset($prev['isPV']) && $prev['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $prev['name']; echo "/".$prev['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-backward"></span></button></a>
							<?php endif; ?>
							<?php if(isset($next)): ?>
								<a class="next_button" href="<?php echo base_url(); if(isset($next['isPV']) && $next['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $next['name']; echo "/".$next['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-forward"></span></button></a>
							<?php endif; ?>	
						</p>
						
						
						<?php // if(isset($result[$product_version_number]->subcategoryTitle)):?>
					<!--		<h4 id="ver-title"><?php // echo $result[$product_version_number]-> subcategoryTitle; ?></h4> -->
					<?php // endif;?>
					
						<div class="row" id="productIMG-holder">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
								<img id="productIMG" src="<?php echo base_url();?>content/images/<?php echo str_replace(array("md/", "sm/"), "lg/", $result[$product_version_number]->img);?>", id="product_version_big_img" class="img-responsive img-rounded">
								<div id="loading" style="display:none; position:absolute; width:100%; height:100%; top:0; background-color: rgba(255,255,255,0.5); background-image: url(http://butorstudiogalgaheviz.hu/images/loading.gif); background-size: 100px 100px; background-repeat:  no-repeat; background-position: center center; "></div>
							</div>
						</div>
						<p>&nbsp;</p>
						
						<!-- <p class="text-center"><?php //echo $result[0]->text?></p>-->
						
						
						
						
						<!-- <p class="text-center"><strong></strong><br>
							<a href=""></a><br>
							<a href=""></a><br>
						</p> -->
						
						<div class="row"  id="version-thumbs">
						
						<?php foreach($result as $resultKey => $resultItem): ?>
						
							
							
							<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
								<div class="thumbnail product-versions" >
									<a class="thumb-href" href="<?php echo base_url(); echo $link; echo $resultItem->Pname; echo "/".$resultItem->Pid."/".($resultKey+1);?>"><img src="<?php echo base_url();?>content/images/<?php echo $resultItem->img;?>"></a>
									<p class="text-center"><a class="thumb-text-href" href="<?php echo base_url(); echo $link; echo $resultItem->Pname; echo "/".$resultItem->Pid."/".($resultKey+1);?>"><?php echo $resultItem->subcategoryTitle; ?></a></p>
								</div>
							</div>
						
						<?php endforeach; ?>	
						
						</div>
					
					<div id="PrText">
						<p class="text-left">
							<?php 
									if(isset($result[0]->CaText))echo $result[0]->CaText;
									else	if(isset( $result[0]->PrText))echo $result[0]->PrText;
									else	if(isset( $result[0]->text))echo $result[0]->text;
							?>
						</p>
						</div>
						
						<br><br>
						<p class="text-center">
							<?php if(isset($prev)): ?>
								<a class="prev_button" href="<?php echo base_url(); if(isset($prev['isPV']) && $prev['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $prev['name']; echo "/".$prev['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-backward"></span></button></a>
							<?php endif; ?>
							<?php if(isset($next)): ?>
								<a class="next_button" href="<?php echo base_url(); if(isset($next['isPV']) && $next['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $next['name']; echo "/".$next['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-forward"></span></button></a>
							<?php endif; ?>	
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
