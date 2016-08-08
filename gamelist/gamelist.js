var json;
document.write("<script src='/static/javascript/function.js'></script>");

$(document).ready(function(){
	$.ajax({
		url:'getGamelist.php',
		type:'post',
		success:function(data){
			json = data;
			writeList();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

	$.each(["game","user","note"],function(key, value){
		$("#"+value).click(function(){
			json = sortJson(json, $(this).attr('id'));
			writeList();
		});
	});
});

function writeList(){
	var str = "";
	$.each(json,function(i,object){
		str += '<tr>';
		str += '<td>'+object["game"]+'</td>';
		str += '<td>'+object["user"]+'</td>';
		str += '<td>'+object["note"]+'</td>';
		if(object["edit"] == true){
			var id = "d"+object["id"];
			str += "<td><a href=''>O</a> <a id='"+id+"' class = 'del'>X</a></td>";
		}
		str += '</tr>';
	});
	$("#list").html(str);
	$(".del").click(function(){
		var txt = $(this).parent().parent().children().first().html();
		if (confirm("정말로 "+txt+"를 삭제하시겠습니까?") == true) {
			var i = $(this).attr("id").substr(1);
			deleteGame(i);
		}

	});
}

function showAddGame(){
    var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 200)/2);
	var option = "width=400, height=200,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("add","",option);
}
function showAddGameRank(){
	var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 450)/2);
	var option = "width=400, height=450,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("add","",option);
}

function deleteGame(id){
	$.ajax({
		url:"delete.php",
		type:"post",
		data:{"id":id},
		success:function(data){
			$("#d"+id).parent().parent().remove();
		}
	});
}