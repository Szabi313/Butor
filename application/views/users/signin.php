<meta charset="utf8">
<meta name="viewport" content="with=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sm.css">

<div id="content">
<h2>Regisztráció</h2>

<?php echo validation_errors(); ?>

<?php //var_dump($groups); ?>

<?php echo form_open('users/signin'); ?>

<fieldset>
<legend>Regisztráció</legend>

<label for="usr">Felhasználónév: </label><br>
<input id="usr" name="usr"><br>

<label for="psw">Jelszó: </label><br>
<input id="psw" name="psw"><br>





<?php //if(isset($groups)):?>
<!--<label for="group">Csoport: </label>
<!--<select name="group">
<!--<option selected value="">Kérem válasszon!</option>
	<?php //foreach($groups as $group):?>
	<!--	<option value="<?php //echo $group->id; ?>"><?php //echo $group->name;?></option>
	<?php //endforeach; ?>
<!--</select>-->
<br>
<?php //endif;?>


<input type="submit" id="submit" name="submit" value="regisztráció">


</fieldset>

</form>
</div>