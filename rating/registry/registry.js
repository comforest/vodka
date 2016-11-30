function registry(){
	var nickname = $("input[name='nickname']").val();

	if(nickname.replace(/ /g,"") == ""){
		return;
	}else if(nickname.length > 10){
		return;
	}


	$.ajax({
		url:'check.php',
		type:'post',
		data:{nickname:nickname},
		success:function(data){
			if(data == false){
				console.log("닉네임 이미 존재");
			}else if(data == true){
				console.log("success");
			}else{
				console.log("Error");
			}
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
}