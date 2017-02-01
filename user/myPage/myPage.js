// document.write("<script src='/static/javascript/function.js'></script>");
// $(document).ready(function(){
// 	$.each(["game","note"],function(key, value){
// 		$("#"+value).click(function(){
// 			json = sortJson(json, $(this).attr('id'));
// 			writeList();
// 		});
// 	});
// });

function editPhone() {
	var txt = $("input[name='phone']").val();
	var regExp = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
	if(!regExp.test(txt)){
	    	alert("잘못된 휴대폰 번호입니다. 올바르게 입력해주세요.");
	    	return false;
	}

	txt = txt.split(" ").join("").split("-").join("");

	$.ajax({
		url:"editPhone.php",
		type:"post",
		data:{phone:txt},
		success:function(data){
			if(data){
				alert("전화번호가 변경되었습니다.");
			}
		}
	});
}