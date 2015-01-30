/*
 *this is a file for my project.
 *there are many functions work for my web heree.
 *if you are interested, you can come with me.
 *so just have fun.
 *words like the wind!
 */

/*
 *
 */
function createTable(position, data){
		var table = "";
		table += "<table border='1' align='center'>";
		var rownum = data.length;
		var colnum = data[0].length;
		for(var i=0 ; i < rownum; i ++){
				table += "<tr>";
				for(var j = 0; j < colnum; j ++){
						table += "<td>";
						table += htmlEncode(data[i][j]);
						table += "</td>";
				}
				table += "</tr>";
		}
		table += "</table>";
		return position.html(table);
}	
function formdata(data){
		var table = "";
		table += "<tr>";
		for( var i = 0; i < data.length; i++){ 
				table += "<td>";
				table += htmlEncode(data[i]);
				table += "</td>";
		}
		table += "</tr>";
		return table;
}


function htmlEncode(str){
		return $('<div/>').text(str).html();
}

function htmlDecode(str){
		return $('<div/>').html(str).text();
}

//except the login page
function isLogin(){
		$.post(
						"user.php?func=isLogin",
						function(data){
						data = JSON.parse(data);
						if(data.code != 0){
						alert(data.msg);
						location.href = "index.html";
						return false;
						}
						}
			  );
}

//just for the login page
function checkLogin(){
		$.post(
						"user.php?func=isLogin",
						function(data){
						data = JSON.parse(data);
						if(data.code == 0){
						alert('you hava loginned, if you want to change account,please logout in the dashboard page first!!!'
							 );
						location.href = "dashboard.html";
						return false;
						}
						}
			  );
}

function heightSync(left, right){
		var lh = left.height();
		var rh = right.height();
		(left > right)?(right.height(left)):(left.height(right));
}

//check the empty input
function isEmpty(element){
		var value = element.val();
		if(value == ""){
				alert("input could not be empty");
				return true;
		}
		return false;
}

//build a table which show the data from the database'tables;
function makeTable(table, position){
		var url = "";
		url += table + ".php?func=get";
		$.getJSON(
						url,
						function(data){
						var url2 = "";
						url2 += table + "info.html";
						if(data.code != 0){
						alert(data.msg);
						location.href = url2;
						return false;
						}
						var strHtml = "";
						position.empty();
						var i = 0;
						strHtml += "<table border='1' align='center'>";
						$.each(
								data.data,
								function(infoIndex, info){
								//make the head line at first
								$.each(
										info,
										function(key, val){
											strHtml += "<td>key</td>";
										}
									  );//after this each, i can get the head line"<td>id</td><td>name</td>..."
								//make the data line 
								}
							  );
						}
		);






























}
