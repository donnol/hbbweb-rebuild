<?php
	require_once(dirname(__FILE__).'/book/book.php');
	require_once(dirname(__FILE__).'/user/user.php');
	$user = new User();
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}
	
	$book = new Book();
	$result = $book->get();
	if( $result['code'] == 0 ){
		$data = $result['data'];
	}else{
		echo $result['msg'];
		exit(0);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<title>book info</title>
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$("button#addbook").click(function(){
				htmlobj = $.ajax({url:"addBook.php", async:false});
			$("div#tagBook").html(htmlobj.responseText);
			});
		});
	</script>
</head>

<body>
	<div class="nav">
		<form name="userinfo" action="#" method="post">
			<table border='1' align='center'>
				<tr>
					<td>index</td>
					<td>id</td>
					<td>name</td>
					<td>category</td>
					<td>page</td>
					<td>content</td>
					<td>delete</td>
				</tr>
			<?php
				foreach( $data as $index=>$singleData ){
					@$id = $book->htmlEncode($singleData[id]);
					@$name = $book->htmlEncode($singleData[name]);
					@$cate = $book->htmlEncode($singleData[category]);
					@$page = $book->htmlEncode($singleData[page]);
					@$content = $book->htmlEncode($singleData[content]);
					echo "
						<tr>
							<td>";
							echo "<a href=\"updateBook.php?id=$id\">$index</a></td>
							<td>";
							 echo "$id</td>
							<td> ";
							echo "$name </td>
							<td> ";
							echo "$cate </td>
							<td> ";
							echo "$page</td>
							<td> ";
							echo "$content </td>
							<td><a href=\"book.php?func=del&id=$id\">delete</a></td>
						</tr>
					";
				}
			?>
		</table>	
		</form>
		<div>
			<button id="addbook" name="addbook" class="nav_btn" >add</button>
		</div>
		<div id="tagBook">
			<h2>add book</h2>
		</div>
	</div>
</body>
</html>
