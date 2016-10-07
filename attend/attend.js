function PeopleCheck(){
	var id = $("input[name=id]").val();
	var arr = $("#people").val().split("\n");

	$.ajax({
		url:"check.php",
		data:{id:id,list:arr},
		type:'post',
		success:function(data){
			var str;
			$.each(data.complete, function(k,v){
				str = "<tr>";
				str += "<td>"+v.name+"</td>";
				str += "<td>"+v.student_id+"</td>";
				str += "<td>"+v.major+"</td>";
				str += "<td>X</td>";
				$("#list").append(str);
			});
			
			$("#check").html("");

			str = "";
			$.each(data.samename, function(key,value){
				$.each(value,function(k,v){
					str += "<input type='checkbox' name="+v.name+" value="+v.id+" "+v.checked+">"+v.name+" "+v.student_id+" "+v.major;
					str += "<br>";

				});
				str += "<br>";
			});

			if(str != ""){
				console.log("test");
				str = "동명 이인 리스트<br>"
						+ str
						+ "<input type='submit' value='저장' onclick='FinalCheck()'>";
			}
			$("#check").append(str);

		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}	
	});
}

function FinalCheck(){
	var id = $("input[name=id]").val();
	$.each($("input:checked"),function(k,v){
		$.ajax({
			url:"FinalCheck.php",
			data:{id:id,user:v.value},
			type:'post',
			success:function(data){
				console.log(data);
				//$("#check").html(data);
			}
		});	
	});
}