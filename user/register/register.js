var BcheckID = false;
var BcheckPW1 = false;
var BcheckPW2 = false;
var BcheckNick = false;
$(document).ready(function(){
	$("#info").hide();
	$("input[name='ID']").change(function(){
		checkID();
	});


	$("input[name='pass']").change(function(){
		var PW = $(this).val();

		checkPW1();
		checkPW2();
	});


	$("input[name='passCheck']").change(function(){
		checkPW2();
	});

	$("input[name='nick']").change(function(){
		checkNick();
	});
});




function checkMember(){
	var name = $("input[name='name']");
	var studentID = $("input[name='studentID']");
	var phone = $("input[name='phone']");


	if(name.val().replace(/ /g,"")==""){
		alert("이름을 입력해주세요.");
		name.focus();
	}else if(studentID.val().replace(/ /g,"")==""){
		alert("학번을 입력해주세요.");
		studentID.focus();
	}else if(phone.val().replace(/ /g,"") == ""){
		alert("전화번호를 입력해주세요.");
		phone.focus();
	}else{
		$.ajax({
			url:"checkMember.php",
			type:"post",
			data:{"name":name.val(),"studentID":studentID.val(),"phone":phone.val().replace(/-/g,"").replace(/ /g,"")},
			success:function(data){
				switch(data){
					case "1":
						$("#check").hide();
						$("#info").show();
						break;
					case "2":
						alert("이미 계정이 존재합니다.");
						break;
					case "3":
						alert("보드카 회원 목록에 존재하지 않습니다.")
						break;

				}
			}
		});
	}
}


function checkID(){
	BcheckID = false;

	var inputBox = $("input[name='ID']");
	var ID = inputBox.val();
	var p = inputBox.next();

	inputBox.removeClass("correct wrong");
	p.removeClass("correct wrong");

	if(ID.replace(/ /g,"") == ""){
		p.text("아이디를 입력 해주세요.");
		p.addClass("wrong");
		inputBox.addClass("wrong");
		return;
	}

	$.ajax({
		url:"checkID.php",
		type:"post",
		data:{"id":ID},
		success:function(data){
			if(data == "1"){
				p.text("사용 가능한 아이디 입니다.");
				p.addClass("correct");
				inputBox.addClass("correct");
				BcheckID = true;
			}else if(data == "2"){
				p.text("이미 존재하는 아이디 입니다.");
				p.addClass("wrong");
				inputBox.addClass("wrong");				
			}
		}
	});
}

function checkPW1(){
	BcheckPW1 = false;

	var inputBox = $("input[name='pass']");
	var pw = inputBox.val();
	var p = inputBox.next();

	p.removeClass("correct wrong");
	inputBox.removeClass("correct wrong");


	if(pw.length < 6){
		p.text("암호가 짧습니다.");
		p.addClass("wrong");
		inputBox.addClass("wrong");
		return;
	}else{
		p.text("올바른 암호입니다.");
		p.addClass("correct");
		inputBox.addClass("correct");
		BcheckPW1 = true;
	}

}

function checkPW2(){
	BcheckPW2 = false;
	var inputBox = $("input[name='passCheck']");
	var pass1 = $("input[name='pass']").val();
	var pass2 = inputBox.val();

	var p = inputBox.next();


	inputBox.removeClass("correct wrong");
	p.removeClass("correct wrong");

	if(pass1 == pass2){
		p.text("비밀번호가 일치 합니다.");
		p.addClass("correct");
		inputBox.addClass("correct");
		BcheckPW2 = true;
	}else{
		p.text("비밀번호가 일치하지 않습니다.");
		p.addClass("wrong");
		inputBox.addClass("wrong");
	}
}

function checkNick(){
	BcheckNick = false;

	var inputBox = $("input[name='nick']");
	var nick = inputBox.val();
	var p = inputBox.next();

	inputBox.removeClass("correct wrong");
	p.removeClass("correct wrong");

	if(nick.replace(/ /g,"") == ""){
		p.text("닉네임을 입력 해주세요.");
		p.addClass("wrong");
		inputBox.addClass("wrong");
		return;
	}

	$.ajax({
		url:"checkNick.php",
		type:"post",
		data:{"nick":nick},
		success:function(data){
			if(data == "1"){
				p.text("사용 가능한 닉네임 입니다.");
				p.addClass("correct");
				inputBox.addClass("correct");
				BcheckNick = true;
			}else if(data = "2"){
				p.text("이미 존재하는 닉네임 입니다.");
				p.addClass("wrong");
				inputBox.addClass("wrong");				
			}
		}
	});
}

function register(){
	
	if(!BcheckID){
		alert("아이디를 확인해 주세요");
		return;
	}
	if(!BcheckPW1 || !BcheckPW2){
		alert("비밀번호를 확인해 주세요");
		return;
	}
	if(!BcheckNick){
		alert("닉네임을 확인해 주세요");
		return;
	}

	var id = $("input[name='ID']").val();
	var pw = $("input[name='pass']").val();
	var nick = $("input[name='nick']").val();

	$.ajax({
		url:"register.php",
		type:"post",
		data:{"id":id,"pw":pw,"nick":nick},
		success:function(data){
			console.log(data);
			if(data == "1"){
				alert("완료");
				location.href="/";
			}else if(data == "2"){ //MYSQL ERROR
				alert("알 수 없는 문제가 발생하였습니다. 처음부터 다시 해보시고 같은 문제가 발생할 시 개발자에게 연락바랍니다.");
			}else if(data == "3"){ //SESSION Missing
				alert("잘못된 접근입니다. 처음부터 다시 해주세요.");
			}
		}
	});
}