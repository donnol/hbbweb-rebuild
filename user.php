<?php
require_once(dirname(__FILE__).'/user/user.php');
$user = new User();
function add(){
	global $user;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.html");
		exit();
	}
	
	$pwd = '123';
	$result = $user->add(
		$_POST["name"],
		$pwd,
		$_POST["tel"],
		$_POST["addr"],
		$_POST["cert"]
	);
	echo json_encode($result);
}
function del(){
	global $user;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.html");
		exit();
	}
	
	$result = $user->del(
		$_GET["id"]
	);
	if( $result['code'] == 0 ){
		header("Location:dashboard.html");
	}else{
		echo $result['msg'];
	}
}
function update(){
	global $user;
	$result = $user->isLogin();
	if($result['code'] != 0){
		header("Location:index.html");
		exit();
	}
	
	$result = $user->update(
		$_POST["name"],
		$_POST["tel"],
		$_POST["addr"],
		$_POST["cert"],
		$_GET["id"]
	);
	echo json_encode($result);
}
function get(){
		global $user;
		$result = $user->isLogin();
			if( $result['code'] != 0){
						header("Location: index.html");
						exit();
					}
			$result = $user->get();
			echo json_encode($result);
		}
function login(){
	global $user;
	$result = $user->login(
		$_POST['username'],
		$_POST['pwd']
	);
	echo json_encode( $result );
}
function logout(){
	global $user;
	$result = $user->logout();
	echo json_encode( $result );
}
$func = $_GET['func'];
if( $func == 'add')
	add();
else if( $func == 'del' )
	del();
else if( $func == 'update')
	update();
else if( $func == 'login' )
	login();
else if( $func == 'logout' )
	logout();
else if( $func == 'get')
		get();
else
	echo 'unknown func!'.$func;
?>
