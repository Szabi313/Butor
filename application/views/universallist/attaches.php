<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- <meta charset="utf8"> -->


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ul.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/menu_order.css"/>
<script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/redirect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/modernizr.custom.99362.js"></script>


<script>
	Modernizr.load({
		test:Modernizr.borderradius,
		nope:'<?php echo base_url();?>js/PIE.js',
		complete:function(){
			if (window.PIE) {
		        $('.item_row_border_per_page, .item_row_border, .item_row').each(function() {
		            PIE.attach(this);
		        });
			}
			//else alert('Utó PIE');
		}
	});
</script>


