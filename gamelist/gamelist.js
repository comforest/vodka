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
			var id = object["id"];
			str += "<td><a id='e"+id+"' class = 'edit'>O</a> <a id='d"+id+"' class = 'del'>X</a></td>";
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

	$(".edit").click(function(){

		var object = $(this).parent().parent().children().first();
		var game = object.html();
		var note = object.next().next().html();
		
		
	    var left = Math.ceil((window.screen.width - 400)/2);
	    var top = Math.ceil((window.screen.height - 200)/2);
		var option = "width=400, height=200,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";
		window.open("","dialog",option);                                    //인수로  넣어도 동작에는 지장이 없으나 form.action에서 적용하므로 생략

		var frm = document.dummy;
		frm.target = "dialog";
		frm.method = "post";
		frm.game.value = game;
	    frm.note.value = note;
	    frm.id.value = $(this).attr("id").substr(1);
		frm.submit();

	});
}

function showDialog(url,width,height){
    var left = Math.ceil((window.screen.width - width)/2);
    var top = Math.ceil((window.screen.height - height)/2);
	var option = "width="+width+", height="+height+",left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";
	window.open(url,"",option);
}

function deleteGame(id){
	$.ajax({
		url:"delete.php",
		type:"post",
		data:{"id":id},
		success:function(data){
			console.log(data);
			$("#d"+id).parent().parent().remove();
		}
	});
}