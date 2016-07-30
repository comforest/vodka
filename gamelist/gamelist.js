var json;
document.write("<script src='/static/javascript/function.js'></script>");

$(document).ready(function(){
	$.ajax({
		url:'getGamelist.php',
		type:'post',
		success:function(data){
		console.log(data);
			json = data;
			writeList();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
});

function writeList(){
	var str = "";
	$.each(json,function(i,object){
	str += '<tr>';
	str += '<td>'+object["game"]+'</td>';
	str += '<td>'+object["user"]+'</td>';
	str += '<td>'+object["note"]+'</td>';
	str += '</tr>';
	});
	$("#list").html(str);
}

var prevKey;
function sortJson(key){
	if(prevKey == key){
		prevKey ="";
		json = mergeSort(json, key, -1);
	}else{
		prevKey = key;
		json = mergeSort(json, key, 1);
	}
	writeList();
}

function showAddGame(){
    var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 200)/2);
	var option = "width=400, height=200,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("addGame","",option);
}
function showAddGameRank(){
	var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 450)/2);
	var option = "width=400, height=450,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("addGame","",option);
}

function searchUser(){
$.ajax({
	url:'FindUser.php',
	type:'post',
	data:{user:$("input[name=\"user\"]").val()},
	success:function(data){
		console.log(data);
		var str = "";
		for(var i = 0; i < data.length; ++i){
			str += data[i]["student_id"].substr(0,4)+" ";
			str += data[i]["major"]+" ";
			str += data[i]["name"];
		}
		$(".userList").html(str);
	}
});
}

function addGame(){
$.ajax({
	url:'/action/addGame.php',
	type:'post',
	data:{name:$("input[name=\"name\"]").val(),note:$("input[name=\"note\"]").val()},
	success:function(data){
		opener.location.reload(true);
		window.close();
	}
});
}