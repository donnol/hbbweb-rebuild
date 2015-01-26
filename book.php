<?php
require_once(dirname(__FILE__).'/user/user.php');
require_once(dirname(__FILE__).'/book/book.php');
$user = new User();
$book = new Book();
function add(){
	global $user;
	global $book;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}
	
	$result = $book->add(
		$_POST["name"],
		$_POST["cate"],
		$_POST["page"],
		$_POST["content"]
	);
	if( $result['code'] == 0 ){
		header("Location:bookinfo.php");
	}else{
		echo $result['msg'];
	}
}
function del(){
	global $user;
	global $book;
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}
	
	$result = $book->del(
		$_GET["id"]
	);
	if( $result['code'] == 0 ){
		header("Location:bookinfo.php");
	}else{
		echo $result['msg'];
	}
}
function update(){
	global $user;
	global $book;
	$result = $user->isLogin();
	if($result['code'] != 0){
		header("Location:index.php");
		exit();
	}
	
	$result = $book->update(
		$_POST['name'],
		$_POST['cate'],
		$_POST['page'],
		$_POST['content'],
		$_GET['id']
	);
	if($result['code'] ==0){
		header("Location:bookinfo.php");
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
else
	echo 'unknown func!'.$func;
?>