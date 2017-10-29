			<div class="col-lg-7 col-md-8 col-sm-8 "  id="butor-products-image">
				
					<h3 class="butor-caption" id="productTitle"><?php echo $result[0]->title?></h3>
					<div id="butor-big-img-container" class="container-fluid">
						
					<?php if(isset($result[0]->Vtitle)):?>
							<h4><?php echo $result[0]-> Vtitle; ?></h4>
					<?php endif;?>
						
						<p class="text-center">
							<?php if(isset($prev)): ?>
								<a class="prev_button" href="<?php echo base_url(); if(isset($prev['isPV']) && $prev['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $prev['name']; echo "/".$prev['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-backward"></span></button></a>
							<?php endif; ?>
							<?php if(isset($next)): ?>
								<a class="next_button" href="<?php echo base_url(); if(isset($next['isPV']) && $next['isPV']) echo "termek-valtozatok/".$category."/"; else echo "termek/".$category."/"; if(isset($subcategory))echo $subcategory.'/'; else echo '0/'; echo $next['name']; echo "/".$next['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-step-forward"></span></button></a>
							<?php endif; ?>	
						</p>
						
					
						<div class="row" id="productIMG-holder">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
								<img id="productIMG" src="<?php echo base_url();?>content/images/<?php if($result[0]->img)echo $result[0]->img; else echo str_replace(array('sm', 'md'), "lg", $curr['img']);?>" class="img-responsive img-rounded">
								<div id="loading" style="display:none; position:absolute; width:100%; height:100%; top:0; background-color: rgba(255,255,255,0.5); background-image: url(http://butorstudiogalgaheviz.hu/images/loading.gif); background-size: 100px 100px; background-repeat:  no-repeat; background-position: center center; "></div>
							</div>
						</div>
						
						<div id="PrText">
							<p class="text-left" ><?php echo $result[0]->text?></p>
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
				
				
			</div>
