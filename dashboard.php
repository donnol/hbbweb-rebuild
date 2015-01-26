<?php
	require_once(dirname(__FILE__).'/book/book.php');
	require_once(dirname(__FILE__).'/user/user.php');
	$user = new User();
	$result = $user->isLogin();
	if( $result['code'] != 0 ){
		header("Location:index.php");
		exit();
	}
?>
<html>
<head>
	<title> home </title>
	<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
</head>
<body>
	<script type="text/javascript">
    window.onload=function(){
        document.getElementById("left").style.height = document.getElementById("tagContent").offsetHeight+"px";
    }
	</script>
	<div>
	<div style="background-color:#f1f2f3; text-align:center; padding:15px;">
		<!-- wow, the time is so slow that i can feel it wasting -->
		welcome home
		<div>
			<button id="log out" name="log out" style="float:right;" onClick="location.href='user.php?func=logout'">log out</button>
		</div>
	</div>
		<!-- how to design? -->
	<div>
	<div id="left" style="float:left;background-color:#f7f7f7; text-align:left; padding:15px; width: 20%;">
		<ul id="tags">
			<li>
		<!--<a href="" id="h1">User information</a>-->
		<button type="button" id="h1">User information</button>
		</li>
		<li>
		<!--<a href="" id="h2">Book information</a>-->
		<button type="button" id="h2">Book information</button>
		</li>
		</ul>
	</div>
	<div id="tagContent" style="float:right;background-color:#f7f7f7; text-align:center; padding:15px; width:75%;">
		<div id="tag1" style="padding:20px;">
			<h2>hi</h2>
		</div>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function(){
			$("#h1").click(function(){
				htmlobj=$.ajax({url:"userinfo.php", async:false});
			$("#tag1").html(htmlobj.responseText);
			//$("#tag1").attr({"href":"userinfo.php"});
			});
			$("#h2").click(function(){
				htmlobj=$.ajax({url:"bookinfo.php", async:false});
			$("#tag1").html(htmlobj.responseText);
			});
		});
		/*$(document).ready(function(){
			$("#h2").click(function(){
				htmlobj=$.ajax({url:"bookinfo.php", async:false});
			$("#tag1").html(htmlobj.responseText);
			});
		});
		$(document).ready(function(){
			$("[href='userinfo.php']").click(function(){
				htmlobj=$.ajax({url:"userinfo.php", async:false});
			$("#tag1").html(htmlobj.responseText);
			});
		});
		$(document).ready(function(){
			$("a").mouseover(function(){
				htmlobj = $.ajax({url:"userinfo.php", async:false});
			$("#tag1").html(htmlobj.responseText);
			});
		});*/
	</script>
</body>
</html>