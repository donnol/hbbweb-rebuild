//
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

function heightSync(left, right){
		var lh = left.height();
		var rh = right.height();
		(left > right)?(right.height(left)):(left.height(right));
		}
