<meta charset="utf8">



<p><?php if(isset($check_message))echo $check_message."<br>";?></p>


<p><?php if(isset($user_data_data)) echo $user_data_data;?></p>

<p>
<ul>
<?php if(isset($user_data_data)){
		$burl = base_url();
	

		
		echo '<br><li><a href="'.$burl.'users/kijelentkezes">kilépés</a></li>';
	}?>
	
</ul>
</p>