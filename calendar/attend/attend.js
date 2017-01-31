var id;
$(document).ready(function(){
	id = $("input[name=id]").val();
	$.ajax({
		url:"getMember.php",
		data:{id:id},		
		type:'get',
		success:function(data){
			writeMember(data.member,data.d);
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}	

	});
});

function PeopleCheck(){
	var arr = $("#people").val().split("\n");

	$.ajax({
		url:"check.php",
		data:{id:id,list:arr},
		type:'post',
		success:function(data){
			var str;

//////////////////////// 정상적인 처리
			writeMember(data.complete);

/////////////////////// 동명 이인
			str = "";
			$.each(data.samename, function(key,value){
				$.each(value,function(k,v){
					str += "<input type='checkbox' name="+v.name+" value="+v.id+" "+v.checked+">"+v.name+" "+v.student_id+" "+v.major;
					str += "<br>";

				});
				str += "<br>";
			});

			if(str != ""){
				str = "동명 이인 리스트<br>"
						+ str
						+ "<input type='submit' value='저장' onclick='FinalCheck()'>";
			}
			$("#check").append(str);

/////////////////////////// Error
			str = "";
			$.each(data.not_member, function(k,v){
				str += "<br>"+v;
			});

			if(str != ""){
				str = "<br>찾지 못한 회원<br>"	+ str;
			}
			$("#check").append(str);			

		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}	
	});
}

function FinalCheck(){
	$.each($("input:checked"),function(k,v){
		$.ajax({
			url:"finalCheck.php",
			data:{id:id,user:v.value},
			type:'post',
			success:function(data){
				writeMember(data);
			}
		});	
	});
}


/*
json : [
	{name:N, student_id:ID, major: M},
	{}

]
*/
function writeMember(json, d=true){
	$.each(json, function(k,v){
		str = "<tr>";
		str += "<td>"+v.name+"</td>";
		str += "<td>"+v.student_id.substr(2,2)+"</td>";
		str += "<td>"+v.major+"</td>";
		if(d) str += "<td><a onclick='deleteMember("+v.student_id+",this)'>X</a></td>";
		$("#list").append(str);
	});
	
	$("#check").html("");
}


function deleteMember(Sid,t){
	$.ajax({
		url:"delete.php",
		data:{id:id,user:Sid},
		type:'POST',
		success:function(data){
			$(t).parent().parent().remove();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		} 
	});
}