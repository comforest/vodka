function saveInfo(){
	var arr = [];

	$.each($(".name"),function(k,v){
		if(v.value != ""){
			var txt = v.name.substr(4);
			var score = $("input[name=score"+txt+"]");
			if(score.val() == "") return;
			arr.push({name:v.value, score:score.val()});
		}
	});

	if(arr.length <= 1) return;

	arr.sort(function(a,b) {
	    return b.score - a.score;
	});

	var rank = 1;
	var prevScore = -1;
	$.each(arr,function(k,v){
		if(prevScore != v.score) rank=k+1;
		arr[k]["rank"] = rank
		prevScore = v.score;
	});



	json = {game:$("option:selected").val(),detail:arr};


	$.ajax({
		url:'add.php',
		type:'post',
		data:{data:json},
		success:function(data){
			switch(data["status"]){
				case "success":
					console.log("success");
					break;
				case "ErrorNick":
					console.log(data["message"]);
					break;
				default:
					console.log(data);
			}
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
}


function setInput(){
	var num = $("option:selected").attr("data-member");
	var str = "";

	for (var i = 1; i <= num; i++) {
		str += "<tr>";
		str += "<td>플레이어 " + i + "</td>";
		str += "<td> <input class='name' type='text' name='name" + i + "'> </td>";
		str += "<td> <input type='number' name='score" + i + "'> </td>";
		str += "</tr>";
	}

	$("#player-list").html(str);
}