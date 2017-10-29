<meta charset="utf8">
<?php if(isset($error))var_dump($error);?>
<?php if(isset($list))var_dump($list);?>

		<br><?php echo $list[0]->menu_date;?> <br> <?php echo $monday[1];?>


<div class="menu_container">


	<div class="menu_row menu_header">
	
		<div class="menu_first_item menu_header_first_item"></div> <!-- menu_first_item menu_header_first_item -->
		
		<div class="menu_item menu_header_item"><?php echo $categories['menuTypes'][0]->name;?></div> <!-- menu_item menu_header_item -->
		<div class="menu_item menu_header_item"><?php echo $categories['menuTypes'][1]->name;?></div> <!-- menu_item menu_header_item -->
		<div class="menu_item menu_header_item"><?php echo $categories['menuTypes'][2]->name;?></div> <!-- menu_item menu_header_item -->
		<div class="menu_item menu_header_item"><?php echo $categories['menuTypes'][3]->name;?></div> <!-- menu_item menu_header_item -->
		<div class="menu_item menu_header_item"><?php echo $categories['menuTypes'][4]->name;?></div> <!-- menu_item menu_header_item -->
			
	</div> <!-- menu_row menu_header -->

	
	
 <!-- Hétfő -->	
	<div class="menu_row">
	
		<div class="menu_item menu_first_item">Hétfő<br><span class="menu_day"><?php echo $monday[0]?></span></div> <!-- menu_first_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 1 && $listItem->menu_date == $monday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?></div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 2 && $listItem->menu_date == $monday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 3 && $listItem->menu_date == $monday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 4 && $listItem->menu_date == $monday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 5 && $listItem->menu_date == $monday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
			
	</div> <!-- menu_row -->
<!-- Hétfő vége-->	

	
		
 <!-- Kedd -->	
	<div class="menu_row">
	
		<div class="menu_item menu_first_item">Kedd<br><span class="menu_day"><?php echo $tuesday[0]?></span></div> <!-- menu_first_item -->
		
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 1 && $listItem->menu_date == $tuesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 2 && $listItem->menu_date == $tuesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 3 && $listItem->menu_date == $tuesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 4 && $listItem->menu_date == $tuesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 5 && $listItem->menu_date == $tuesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
			
	</div> <!-- menu_row -->
 <!-- Kedd vége -->	
	
		
		
 <!-- Szerda -->	
	<div class="menu_row">
	
		<div class="menu_item menu_first_item">Szerda<br><span class="menu_day"><?php echo $wednesday[0]?></span></div> <!-- menu_first_item -->
		
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 1 && $listItem->menu_date == $wednesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 2 && $listItem->menu_date == $wednesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 3 && $listItem->menu_date == $wednesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 4 && $listItem->menu_date == $wednesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 5 && $listItem->menu_date == $wednesday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
	
	</div> <!-- menu_row -->
 <!-- Szerda vége -->	
	
		
		
 <!-- Csütörtök -->	
	<div class="menu_row">
	
		<div class="menu_item menu_first_item">Csütörtök<br><span class="menu_day"><?php echo $thursday[0]?></span></div> <!-- menu_first_item -->
		
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 1 && $listItem->menu_date == $thursday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 2 && $listItem->menu_date == $thursday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 3 && $listItem->menu_date == $thursday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 4 && $listItem->menu_date == $thursday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 5 && $listItem->menu_date == $thursday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		
	</div> <!-- menu_row -->
 <!-- Csütörtök vége -->	
	
		
		
 <!-- Péntek -->	
	<div class="menu_row">
	
		<div class="menu_item menu_first_item">Péntek<br><span class="menu_day"><?php echo $friday[0]?></span></div> <!-- menu_first_item -->
		
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 1 && $listItem->menu_date == $friday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 2 && $listItem->menu_date == $friday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 3 && $listItem->menu_date == $friday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 4 && $listItem->menu_date == $friday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		<div class="menu_item"><?php foreach ($list as $listItem){if($listItem->menuTypes == 5 && $listItem->menu_date == $friday[1]){echo $listItem->name; echo '<br><input type="number" min="0">';}}?> </div> <!-- menu_item -->
		
	</div> <!-- menu_row -->
<!-- Péntek vége -->	
	
	
	
	
</div> <!-- menu_container -->