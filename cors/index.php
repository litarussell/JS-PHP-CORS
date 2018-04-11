<?php 
	include "./method.php";

	// @$path = explode("/", $_SERVER['PATH_INFO']);

	// @$method = $path[1];
	@$method = $_GET['m'];
	@$callback = $_GET['callback'];

	class Cors extends Method {
		
	}

	$m = new Cors;

	if (!$method) {
		echo "hello";
		return 1;
	}

	if ($callback) {
		echo $m->$method($callback);
	}else{
		$re = json_encode(array(
			"data"=> $m->$method()
		));

		echo $re;
	}
	
 ?>