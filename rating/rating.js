var data;
document.write("<script src='/static/javascript/function.js'></script>");

$(document).ready(function(){
	$.ajax({
		url:'getRating.php',
		type:'post',
		success:function(d){
			data = d;
			console.log(d);
			writeList(1);
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

});

var sarr = {name:"이름", nickname:"닉네임", rating:"레이팅", number:"게임수", rank:"순위"};

function setTable(){
	var n = $("option:selected").val();
	writeList(n);
}

function writeList(index){
	var json = data[index];
	var str = "";
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
			if(value==null){
				json[i][key] = '';
				value='';
			}
			str+="<td>"+value+"</td>";	
		});
		str+="</tr>";
	}
	str +=	"</tbody>";

	$("#list").html(str);


	for(key in sarr){
		$("#"+key).click(function(){
			data[index] = sortJson(data[index], $(this).attr('id'));
			writeList(index);
		});
	}
}
