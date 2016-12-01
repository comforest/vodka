function registry(){
	var nickname = $("input[name='nickname']").val();

	if(nickname.replace(/ /g,"") == ""){
		alert("닉네임을 입력해주세요.");
		return;
	}else if(nickname.length > 10){
		alert("닉네임이 너무 깁니다. 10자 이내로 해주세요.");
		return;
	}


	$.ajax({
		url:'check.php',
		type:'post',
		data:{nickname:nickname},
		success:function(data){
			if(data == false){
				alert("닉네임이 이미 존재합니다.");
			}else if(data == true){
				alert("닉네임이 정상적으로 입력되었습니다.");
				location.reload(true);
			}else{
				alert("알 수 없는 오류가 발생하였습니다.");
			}
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
}