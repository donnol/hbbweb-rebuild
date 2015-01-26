<?php
require_once(dirname(__FILE__).'/user/user.php');
$user = new User();
function add(){
	global $user;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
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
	if( $result['code'] == 0 ){
		header("Location:dashboard.php");
	}else{
		echo $result['msg'];
	}
}
function del(){
	global $user;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}
	
	$result = $user->del(
		$_GET["id"]
	);
	if( $result['code'] == 0 ){
		header("Location:dashboard.php");
	}else{
		echo $result['msg'];
	}
}
function update(){
	global $user;
	$result = $user->isLogin();
	if($result['code'] != 0){
		header("Location:index.php");
		exit();
	}
	
	$result = $user->update(
		$_POST["name"],
		$_POST["tel"],
		$_POST["addr"],
		$_POST["cert"],
		$_GET["id"]
	);
	if( $result['code'] == 0){
		header("Location:dashboard.php");
	}else{
		echo $result['msg'];
	}
}
function login(){
	global $user;
	$result = $user->login(
		$_POST['username'],
		$_POST['pwd']
	);
	if( $result['code'] == 0 ){
		header("Location:dashboard.php");
	}else{
		echo $result['msg'];
	}
}
function logout(){
	global $user;
	$result = $user->logout();
	if( $result['code'] == 0 ){
		header("Location:index.php");
	}else{
		echo $result['msg'];
	}
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
else
	echo 'unknown func!'.$func;
?>