<?php 
	/**
	* 
	*/
	class Method {
		// 自定义头跨域,这也是非简单命令请求,先要发送预检命令
		function header(){
			@$headers = $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'];
			@$origin = $_SERVER['HTTP_ORIGIN'];

			if (!empty($origin)) {
				header("Access-Control-Allow-Origin: $origin");
			}
			if (!empty($headers)){
				header("Access-Control-Allow-Headers: $headers");
				// 缓存预检命令的结果
				header("Access-Control-Max-Age: 3600");
			}
			
			return "header aaa bbb";
		}
		// 带cookie的跨域
		function cookie(){
			header("Access-Control-Allow-Credentials: true");
			$origin = $_SERVER['HTTP_ORIGIN'];
			if (!empty($origin)) {
				header("Access-Control-Allow-Origin: $origin");
			}
			@$v = $_COOKIE["name"];
			return "cookie ".$v;
		}
		// 非简单命令,先发送预检命令
		function postjson(){
			header("Access-Control-Allow-Origin: *");
			// 由于发送的是json数据,也就是定义了头content-type="application/json"
			header("Access-Control-Allow-Headers: content-type");
			// 缓存预检命令的结果
			header("Access-Control-Max-Age: 3600");
			$data = file_get_contents('php://input');
			$v = json_decode($data,true);
			return "post json ".$v['name'];
		}
		// 被调用方的filter解决跨域
		function filter(){
			header("Access-Control-Allow-Origin: *");
			// header("Access-Control-Allow-Method: *");
			return "被调用方 filter解决跨域";
		}
		// jsonp跨域
		function jsonp($callback){
			$data = json_encode(array(
				"data"=> "jsonp"
			));
			return $callback."(".$data.")";
		}
		// Ajax通过post发送json数据，带contentType:"application/json"
		function ajaxpost(){
			$data = file_get_contents('php://input');
			// $v = json_decode($data);;//返回对象
			// return "ajax ".$v->name;
			$v = json_decode($data,true);
			return "ajax ".$v['name'];
		}
		// 测试
		function a(){
			return "测试";
		}
	}
 ?>