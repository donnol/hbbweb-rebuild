<?php
	require_once(dirname(__FILE__).'/book/book.php');
	require_once(dirname(__FILE__).'/user/user.php');
	$user = new User();
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}

	$result = $user->get();
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
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$("button#adduser").click(function(){
				htmlobj = $.ajax({url:"addUser.php", async: false});
			$("div#add").html(htmlobj.responseText);
			});
		});
	</script>
<title>user info</title>
</head>
<body>
	<div class="nav">
		<form name="userinfo" action="#" method="post">
			<table border='1' align='center'>
				<tr>
					<td>index</td>
					<td>id</td>
					<td>name</td>
					<td>tel</td>
					<td>addr</td>
					<td>cert</td>
					<td>delete</td>
				</tr>
			<?php
				foreach( $data as $index=>$singleData ){
					@$id = $user->htmlEncode($singleData[id]);
					@$name = $user->htmlEncode($singleData[name]);
					@$tel = $user->htmlEncode($singleData[tel]);
					@$addr = $user->htmlEncode($singleData[addr]);
					@$cert = $user->htmlEncode($singleData[cert]);
					echo "
						<tr>
							<td>";
							echo "<a href=\"updateUser.php?id=$singleData[id]\">$index</a></td>
							<td>";
							 echo "$id</td>
							<td> ";
							echo "$name </td>
							<td> ";
							echo "$tel </td>
							<td> ";
							echo "$addr</td>
							<td> ";
							echo "$cert </td>
							<td><a href=\"user.php?func=del&id=$id\">delete</a></td>
						</tr>
					";
				}
			?>
		</table>	
		</form>
		<div id="add"><h2>add user</h2></div>
		<div>
			<button id="adduser" name="adduser" type="button"  class="nav_btn">add</button>
		</div>
	</div>
</body>
</html>
