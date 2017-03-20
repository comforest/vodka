function login(){
	var id = $("input[name='id']").val();
	var pass = $("input[name='pass']").val();
	var auto = $("input[name='auto']").is(":checked");
	
	if(id==""){
		alert("아이디를 입력해주세요.");
	}else if(pass==""){
		alert("비밀번호를 입력해주세요.");
	}else{
		$.ajax({
			url:"/action/login_action.php",
			type:"post",
			data:{"id":id,"pass":pass,"auto":auto},
			success:function(data){
				console.log(data);
				if(data == true){
					var url = $("input[name='url']").val();
					location.href=url;
				}else{					
					alert("ID 또는 비밀번호가 틀렸습니다.");
				}
			}
		});
	}
}