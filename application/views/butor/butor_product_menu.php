	<div class="container-fluid" id="slide">
		
		
		
		<div class="row" id="butor-content">
			<div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-4" id="butor-products-list">
				<h3 class="butor-caption">Termékeink</h3>
				<nav class="navbar navbar-default">
						<div class="container-fluid">
	<!--						<div class="nav navbar-nav"> -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
  					     		 <span class="icon-bar"></span>
    					   			<span class="icon-bar"></span>
     							   <span class="icon-bar"></span> 
  						    </button>
								<!--	<a href="" class="navbar-brand" style="height: 20px">Termékmenü</a>-->
								</div>
								
								<div class="collapse navbar-collapse" id="myNavbar" style="background-color: #fff">
								
								<ul class="nav navbar-nav nav-stacked" id="butor-product-menu">
								
									<?php foreach($menu as $menu_key => $menu_item):?>
										<li <?php if(isset($menu_item['subcategory']) && !$menu_item['all_in']) echo 'class="dropdown"'?>>
											<a <?php if(isset($menu_item['subcategory']) && !$menu_item['all_in']) echo 'class="dropdown-toggle" data-toggle="dropdown"';?> href="<?php echo base_url(); if(isset($menu_item['subcategory']) )echo "alkategoriak/"; else echo "kategoria/"; echo $menu_key; if( $menu_item['all_in'])echo '/1';?>"><?php echo $menu_item['title'];?>
											<?php if(isset($menu_item['subcategory']) && !$menu_item['all_in']):?>
												<span class="caret"></span><?php endif;?>
											</a>
											
											<?php if(isset($menu_item['subcategory']) && !$menu_item['all_in']):?>
												<ul class="dropdown-menu">
													<?php foreach($menu_item['subcategory'] as $miSubCatKey=>$miSubCatVal): ?>
														<li><a href="<?php echo base_url().'alkategoria/'.$menu_key.'/'.$miSubCatKey;?>"><?php echo $miSubCatVal; ?></a></li>
													<?php endforeach; ?>
												</ul>		
											<?php endif; ?>
										
										</li>
										

										
									<?php endforeach;?>
									
								</ul>
						</div>
						</div>
					</nav>
