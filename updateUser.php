<?php
	require_once(dirname(__FILE__).'/book/book.php');
	require_once(dirname(__FILE__).'/user/user.php');
	$user = new User();
	$result = $user->isLogin();
	if($result['code'] != 0){
		header("Location:index.php");
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<title>update user</title>
</head>

<body>
	<div>
		<form action="user.php?func=update&id=<?php echo $_GET['id']?>" method="post" name="adduser">
			<table border="1" align="center">
				<tr>
					<td>Name <input type="text" name="name" align="left" class="nav_td_input" /></td>
				</tr>
				<tr>
					<td>Telephone <input type="text" name="tel" align="left" class="nav_td_input" /></td>
				</tr>
				<tr>
					<td>Address <input type="text" name="addr" align="left" class="nav_td_input" /></td>
				</tr>
				<tr>
					<td>Certificate <input type="text" name="cert" align="left" class="nav_td_input" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" />&nbsp;
					<input type="reset" name="reset" /></td>
				</tr>
			</table>
		</form>

	</div>

</body>
</html>
