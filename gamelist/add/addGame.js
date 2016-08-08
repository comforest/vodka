$(document).ready(function(){
	$("input[name='user'][type='radio']").change(function(){
		if($("input[name='user'][value='검색']").attr("checked") == "checked"){
			$("#userlist").show();
		}else{
			$("#userlist").hide();
		}
	});
});

function searchUser(){
	console.log($("input[name='user'][type='text']").val());
	$.ajax({
		url:'FindUser.php',
		type:'post',
		data:{user:$("input[name='user'][type='text']").val()},
		success:function(data){
			console.log(data);
			var str = "";
			for(var i = 0; i < data.length; ++i){
				str += "<input type='radio' name='searchUser' value=" + data[i]['user_id']+">";
				str += data[i]["student_id"].substr(0,4)+" ";
				str += data[i]["major"]+" ";
				str += data[i]["name"]+"<br>";
			}
			$("#list").html(str);
		}
	});
}

function addGame(){
	var name = $("input[name='name']").val();
	var note = $("input[name='note']").val();
	var user = "my";
	if($("input[type='radio']").length){
		var txt = $("input[type='radio']:checked").val();
		if(txt == "검색"){
			user = $("input[name='searchUser']:checked").val();
		}else{
			user = txt;
		}
	}

	$.ajax({
		url:'addGame.php',
		type:'post',
		data:{name:name,note:note,user:user},
		success:function(data){
			opener.location.reload(true);
			window.close();
		}
	});
}