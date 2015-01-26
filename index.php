<?php
	require_once(dirname(__FILE__).'/user/user.php');
	$user = new User();
	$result = $user->isLogin();
	if( $result['code'] == 0 ){
		header("Location:dashboard.php");
		exit();
	}
?>
<html>
<head>
<title> welcome </title>
<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>
<body>
	<script language="javascript">
		function checklogin(){
 			if((login.username.value!="")&&(login.password.value!=""))
 			{
  				return true;//判断用户名和密码不为空,返回TRUE
 			}
			else
 			{
  				alert ("昵称或密码不能为空!")
			}
		}
	</script>
	
	<div class="nav">
		welcome to login or sign up.
	</div>
	<div>
		<form name="loginform" class="nav_form" action="user.php?func=login" method="post" onSubmit="return checklogin()">
			<table align="center">
				<tr>
					<td>User Name&nbsp;:<input type="text" name="username"></td>
					
				</tr>
				<tr>
					<td>Password&nbsp;&nbsp;:<input type="password" name="pwd"></td>
				</tr>
				<tr>
					<td>
						<input class="nav_form_submit" type="submit" name="login">
					</td>
					<td>
						<input class="nav_form_submit"  type="reset" name="reset">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>