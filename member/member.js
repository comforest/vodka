var json;
document.write("<script src='/static/javascript/function.js'></script>");

$(document).ready(function(){
	$.ajax({
		url:'getMember.php',
		type:'post',
		success:function(data){
			json = data;
			writeList();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

});

var sarr = {name:"이름", student_id:"학번", major:"전공",location:"활동 지역",rank:"등급",entry:"활동 여부",gender: "성별",colleage:"단과대",phone:"전화번호",class:"기수"};

function writeList(){

	var str = "<a onclick=\"SwitchChart()\">차트 보기</a>";
	str += "<table>";
	str +=	"<thead>";
	str +=	"<tr>";
	for(key in json[0]){
		str += "<th id=\""+key+"\">"+sarr[key]+"</th>";
	}
	str +=	"</tr>";
	str +=	"</thead>";
	str +=	"<tbody>";
	for(i in json){
		str+="<tr>";
		$.each(json[i],function(key,value){
			str+="<td>"+value+"</td>";	
		});
		str+="</tr>";
	}
	str +=	"</tbody>";

	$("#memberList").html(str);


	for(key in json[0]){
		$("#"+key).click(function(){
			json = sortJson(json, $(this).attr('id'));
			writeList();
		});
	}
}

function SwitchChart(){
	$("#chart").show();
	$("#memberList").hide();
}

function SwitchList(){
	$("#chart").hide();
	$("#memberList").show();
}