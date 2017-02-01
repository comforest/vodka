function login(){
	var id = $("input[name='id']").val();
	var pass = $("input[name='pass']").val();
	
	if(id==""){
		alert("아이디를 입력해주세요.");
	}else if(pass==""){
		alert("비밀번호를 입력해주세요.");
	}else{
		$.ajax({
			url:"/action/login_action.php",
			type:"post",
			data:{"id":id,"pass":pass},
			success:function(data){
				if(data == false){
					alert("ID 또는 비밀번호가 틀렸습니다.");
				}else{
					var url = $("input[name='url']").val();
					location.href=url;
				}
			}
		})
	}
}