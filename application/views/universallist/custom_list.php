<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


<?php if(isset($list)):?>

	
	<div>
		<?php foreach ($list[0] as $li_key => $li_item):?>
			<span><?php echo $li_key;?></span>
		<?php endforeach;?>
	</div>
	
	
	<?php foreach ($list as $list_item):?>
		<div><a href="<?php echo base_url()."dolgozok/kijelentkeztetes/".$list_item->regId.DIRECTORY_SEPARATOR.$table.DIRECTORY_SEPARATOR.$filter;?>">
			<?php foreach ($list_item as $li_item):?>
				<span><?php echo $li_item;?></span>
			<?php endforeach;?>
		</div></a>
	<?php endforeach;?>

<?php endif;?>
