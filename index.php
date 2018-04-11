<?php 
	include "./cors/method.php";

	// $path = explode("/", $_SERVER['PATH_INFO']);

	// $method = $path[1];
	// 
	$method = $_GET['m'];
	// @$data = file_get_contents('php://input');
	
	class Cors extends Method {
		
	}

	$m = new Cors;
	
	$re = json_encode(array(
		"data"=> $m->$method()
	));

	echo $re
 ?>