<?php 

echo validation_errors();


if(isset($error_message))echo $error_message;

// if(isset($_POST))var_dump($_POST);
?>


<?php if(isset($action) && isset($field_list)):?>

<div class="ul-content" ng-app="butorModule" ng-controller="butorController">

<p><strong><em></>A (*)-gal jelölt mezők kitöltése kötelező!</em></strong></p>

 <form name="itemform" novalidate>
<fieldset>
<legend><strong><?php echo $table;?></strong></legend>

<br>

<!-- AZ EGYES ADATBĂ�ZIS MEZĹ�KET INPUTOKKĂ� ALAKĂŤTJA -->
 
<?php if(isset($field_list)):?> 
<?php foreach ($field_list as $fl_key => $item):?>

	<!-- HA SZEREPEL A MEZĹ� A KATEGĂ“RIĂ�K KĂ–ZT, AKKOR SELECTET CSINĂ�L A MEGADOTT HĂŤVATKOZOTT TĂ�BLA Ă‰RTĂ‰KEIBĹ�L, -->
		 
	<?php if($item->Key !== "PRI" /*$item->Field !== $main_table['primary_key']*/):?>	
		
		<?php if(isset($categories[$item->Field])):?>
			<label><?php echo str_replace(array('e_mail', '_'), array('E-mail', ' '), $item->Field); if(isset($required[$item->Field])) echo " (*)";?>: </label>
			<select name="<?php echo $item->Field;?>" id="<?php echo $item->Field;?>" ng-model="categories['<?php echo $item->Field;?>']" ng-change="changeCategory('<?php echo $table; ?>')">
				<option></option>
				<?php foreach ($categories[$item->Field] as $cat_item):?>
				
					<!-- AZ PRIMARY INDEX LESZ A SELECT VALUE, Ă‰S AZ ELSĹ� NEM KULCS OSZLOP A SELECT TEXT -->
					
					<!-- <option value="<?php //echo $cat_item->id;?>"><?php //echo $cat_item->name;?></option> -->
					<option value="<?php echo $cat_item->$categories_fields[$item->Field]['primary_key'];?>" <?php if(isset($itemToEdit) && $itemToEdit[0]->{$item->Field} == $cat_item->$categories_fields[$item->Field]['primary_key'])echo "selected";?>><?php echo $cat_item->$categories_fields[$item->Field]['non_primary_key'];?></option>
				<?php endforeach;?>
<!-- 				<option value="dfg">nem szĂˇm</option> -->
			</select>
			<br><br>
			
		<?php elseif ($item->Type == "tinyint(1)"):?>
			<label><?php echo str_replace(array('e_mail', '_'), array('E-mail', ' '), $item->Field); if(isset($required[$item->Field])) echo " (*)";?>: </label><input type="checkbox" ng-model="item['<?php echo $item->Field;?>']" name="<?php echo $item->Field;?>" id="<?php echo $item->Field;?>" <?php if(isset($itemToEdit) && $itemToEdit[0]->{$item->Field})echo "checked";?> value="1"><br><br>
<!--			<input type="hidden" name="<?php //echo $item->Field.$checkbox_field_checker;?>" id="<?php //echo $item->Field.$checkbox_field_checker;?>" value="0"> -->
		
		
		<?php elseif ($item->Type == "timestamp"):?>
			<label><?php echo $item->Field; if(isset($required[$item->Field])) echo " (*)";?>: </label><input type="date" name="<?php echo $item->Field;?>" id="<?php echo $item->Field;?>" value=<?php if(isset($itemToEdit))echo $itemToEdit[0]->{$item->Field};?> ><br><br>
		
		
		
		<?php elseif ($item->Type == "text" || $item->Type == "longtext"):?>
		<label><?php echo str_replace(array('e_mail', '_'), array('E-mail', ' '), $item->Field);  if(isset($required[$item->Field])) echo " (*)";?>: </label><br>
		<textarea ui-tinymce="tinymceOptions" rows="20" cols=100 <?php if($fl_key === 0)echo 'autofocus="autofocus"';?> name="<?php echo $item->Field;?>"  class="mytextarea" ng-model="items[currentItemName]['<?php echo $item->Field;?>']">
<?php if(isset($itemToEdit))echo $itemToEdit[0]->{$item->Field};?>
		</textarea><br><br>
		
		
		
		<?php else:?><label><?php echo str_replace(array('e_mail', '_'), array('E-mail', ' '), $item->Field);  if(isset($required[$item->Field])) echo " (*)";?>: </label><input <?php if($fl_key === 0)echo 'autofocus="autofocus"';?> name="<?php echo $item->Field;?>" id="<?php echo $item->Field;?>" value="<?php if(isset($itemToEdit))echo $itemToEdit[0]->{$item->Field};?>" ng-model="items[currentItemName]['<?php echo $item->Field;?>']" ><br><br>
		<?php endif;?>
		
	<?php elseif(isset($itemToEdit)): //END if($item->Key !== "PRI") ?> 
		<input type="hidden" name="<?php echo $item->Field?>" id="<?php echo $item->Field?>" value="<?php echo $itemToEdit[0]->{$item->Field}?>">
	<?php endif; //END main table primary key?>

<?php endforeach;?>
<?php endif; //END isset(field_list)?>

<br>

<input type="submit" ng-click="save('<?php echo $table; ?>')" value="mentés">
<button ng-click="newCategoryUpload()">új</button>

</fieldset>
</form>


<div class="imgBox" ng-click="clickBox(undefined)" ng-show="path[0]"><p>vissza a fő könyvtárba</p></div>
<div class="imgBox" ng-click="clickBox(undefined,-1)" ng-show="path[0]"><p>vissza egyet</p></div>

<div class="imgBox" ng-repeat="(key, img) in currentImages" ng-click="clickBox(img, key)"><input type="number" ng-show="isFile(img, key)" ng-model="items[nameFromImg(img)][fieldNames.order]" ng-change="inputChange(key)" ng-click="inputChange(key)"><br><br><img ng-show="isFile(img, key)" src="<?php echo base_url().'content/images/'; ?>{{imgWithPath(img)}}"><p ng-show="isFile(img, key)">{{img}}</p><p ng-show="!isFile(img, key)">{{key}}</p></div>

<div id="loading" ng-show="showLoading"></div>

	{{categories}}<br><br>
	{{items}}
	


</div>
<?php endif;?>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>


