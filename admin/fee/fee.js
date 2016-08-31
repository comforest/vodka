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

var sarr = {name:"이름", location:"활동 지역",class:"기수",fee:"회비"};

function writeList(){
	var str = "";
	str += "<table>";
	str +=	"<thead>";
	str +=	"<tr>";
	for(key in sarr){
		str += "<th id=\""+key+"\">"+sarr[key]+"</th>";
	}
	str +=	"</tr>";
	str +=	"</thead>";
	str +=	"<tbody>";
	for(i in json){
		str+="<tr>";
		var id;
		$.each(json[i],function(key,value){
			if(value==null){
				json[i][key] = '';
				value='';
			}
			if(key=="fee"){
				str += "<td><input type='checkbox' class='feeCheck' value="+id;
				if (value == 1){
					str += " checked";
				}
				str += "></td>";
			}else if(key =="user_id"){
				id = value;
			}else{
				str+="<td>"+value+"</td>";
			}
		});
		str+="</tr>";
	}
	str +=	"</tbody>";

	$("#List").html(str);


	for(key in json[0]){
		$("#"+key).click(function(){
			json = sortJson(json, $(this).attr('id'));
			writeList();
		});
	}

	$(".feeCheck").change(function(){
		$.ajax({
			url:'setFee.php',
			type:'post',
			data:{id:$(this).attr("value"),val:$(this).is(":checked")},
			error: function (request, status, error) {
				console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
			}
		});
	})
}