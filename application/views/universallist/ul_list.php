<meta charset="utf8">

<?php //var_dump($field_list);?>


<div class="ul-content">
<h3><?php echo $table;?> listája</h3>

<?php if(isset($error_message)) echo $error_message;?>

<?php if (isset($error_message_del)):?>

	<ul class="insert_error">
	<?php foreach ($error_message_del as $em_item):?>
		<li><?php echo $em_item?></li>
	<?php endforeach;?>
	</ul>

<?php endif;?>


<?php if (isset($error_message_del_no_access)):?>

	<ul class="insert_error">
	<?php foreach ($error_message_del_no_access as $emd_item):?>
		<li><?php echo $emd_item?></li>
	<?php endforeach;?>
	</ul>

<?php endif;?>



<?php if(isset($list)):?>

<?php echo form_open(base_url().$form_uri)?>

<div class="buttons">
	<a href="<?php echo base_url().$new_uri?>"><div class="button borderradius" id="new_item">Új</div></a>
	<input class="button borderradius" id="delete_item" type="submit" value="törlés"><!-- Törlés</div> -->
</div>

<div class="item_rows"></div>
	<div class="item header">
	<?php foreach ($list[0] as $field_key => $field):?>
		<span class="field <?php echo $field_key;?> borderradius"><?php echo str_replace(array('e_mail', '_'), array('E-mail', ' '), $field_key) /*$field_key*/ ; ?></span>
	<?php endforeach;?>
	<span class="field delete">Törlés</span>
	</div>
	

	<?php foreach ($list as $list_item):?>
			<div class="item borderradius">
		<a href="<?php echo base_url().$uri.$list_item->$key; //echo base_url().$uri.DIRECTORY_SEPARATOR.$table.DIRECTORY_SEPARATOR.$list_item->$key;?>">
				<?php foreach ($list_item as $field_key => $field):?>
					<?php if(strchr($field_key, "text") === FALSE):?><span class="field <?php echo $field_key;?>">&nbsp;<?php echo $field; ?></span><?php endif;?>
				<?php endforeach;?>
		</a>
				<!-- <span class="field delete"><input type="checkbox" id="<?php //echo $list_item->$key;?>" name="<?php //echo $list_item->$key;?>" value="valami"></span> -->
				<span class="field delete"><input type="checkbox" id="<?php echo $list_item->$key;?>" name="delete[]" value="<?php echo $list_item->$key;?>"></span>
			</div>
	<?php endforeach;?>
</div>
</form>
<?php else:?>
<div class="buttons"></div><br>
	<a href="<?php echo base_url().$new_uri?>"><div class="button borderradius" id="new_item">Új dolgozó rögzítése</div></a>


<?php endif; ?><!-- END if(isset($list)) -->
</div>
