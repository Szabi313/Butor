<?php

		//var_dump($dirmap);

if(isset($dirmap))echo json_encode($dirmap);
else echo json_encode(array('error'=>'no data'));