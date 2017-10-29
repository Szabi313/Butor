<meta charset="utf8">
<meta name="viewport" content="with=device-width, initial-scale=1, user-scalable=no">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sm.css">

<!-- <h2>Belépés</h2> -->


<?php echo validation_errors(); ?>

<?php echo form_open('users/login'); ?>

<div id="content">
<!-- <fieldset>::?
<legend>Belépés</legend> -->

<label for="usr">Felhasználónév: </label><br>
<input id="usr" name="usr"><br>

<label for="psw">Jelszó: </label><br/>
<input type="password" id="psw" name="psw"><br><br>

<input type="submit" id="submit" name="submit" value="belépés">


<!-- </fieldset> -->
</div>

</form>