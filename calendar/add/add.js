$(document).ready(function(){

	today = getDateString(new Date());

	$("input[name='start_date']").val(today);
	$("input[name='end_date']").val(today);


	$("#type").prop("disabled",true);
	$("input").prop("disabled",true);

	$("#repeat").change(function(){
		var txt = $("#repeat option:selected").val();
		if(txt == "none"){
			$("#type").prop("disabled",true);
			$("input").prop("disabled",true);
		}else{
			$("#type").prop("disabled",false);
		}
	});


	$("#type").change(function(){
		var val = $("#type option:selected").val();
		if(val == "none"){
			$("input").prop("disabled",true);
		}else{
			$("input").prop("disabled",false);
			var txt = $("#type option:selected").text();
			$("input[name=title]").val(txt);
		}



	});

	$("input[name='start_date']").change(function(){
		var txt = $(this).val();
		$("input[name='end_date']").val(txt);
	});
});

function addCalendar(){
	var result = {};

	var repeat = $("#repeat").val();
	
	var start = $("input[name=start_date]").val();
	var end = $("input[name=end_date]").val();

	var date = new Date(start);
	var end_date = new Date(end);

	if(date > end_date){
		alert("종료 날짜가 시작 날짜보다 빠를 수 없습니다.");
		return;
	}

	if(repeat == "none"){
		alert("잘못된 방식입니다.");
		return;
	}else if(repeat == "no-repeat"){
		result["group"] = false;
		result["start_date"] = $("input[name=start_date]").val();
		result["end_date"] = $("input[name=end_date]").val();
	}else{
		var optionList = $("#repeat option");
		var index = optionList.index($("#repeat option:selected")) - optionList.index($("#repeat option[value=mon]")) + 1;
		index = index % 7

		index = (index - date.getDay() + 7) % 7;
		date.setDate(date.getDate() + index);

		var arr = [];
		while(date < end_date){
			arr.push(getDateString(date));
			date.setDate(date.getDate() + 7);
		}

		result["group"] = true;
		result["date"] = arr;
	}
	result["type"] = $("#type").val();
	result["text"] = $("input[name=title]").val();
	
	$("input[type=submit]").prop("disabled", true);

	$.ajax({
		url:'addCalendar.php',
		type:'post',
		data:{data:result},	
		success:function(data){
			$("input[type=submit]").prop("disabled", false);
			switch(data["status"]){
				case "success":
					alert("정상적으로 저장되었습니다.");
					location.href="/calendar";
					break;
				case "ErrorRank":
					alert("잘못된 접근입니다.");
					break;
				case "Error":
					if(data["ErrorCode"] == "1"){
						alert("알 수 없는 오류가 발생하였습니다.");
					}else if(data["ErrorCode"] == "2"){
						alert("오류가 발생하였습니다.");
					}else if(data["ErrorCode"] == "3"){
						alert("종료 날짜가 빠릅니다.");
					}
			}
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
}

function getDateString(date){

	var day = ("0" + date.getDate()).slice(-2);
	var month = ("0" + (date.getMonth() + 1)).slice(-2);

	return date.getFullYear()+"-"+(month)+"-"+(day);

}