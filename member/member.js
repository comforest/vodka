var json;
var prevKey;

$(document).ready(function(){
	$.ajax({
		url:'getMember.php',
		type:'post',
		data:{},
		success:function(data){
			json = data;
			writeList();
			writeChart();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

});

function mergeSort(arr, key,s)
{
    if (arr.length < 2)
        return arr;

    var middle = parseInt(arr.length / 2);
    var left   = arr.slice(0, middle);
    var right  = arr.slice(middle, arr.length);

    return merge(mergeSort(left,key,s), mergeSort(right,key,s),key,s);
}

function merge(left, right, key,s)
{
    var result = [];

    while (left.length && right.length) {
        if (left[0][key].localeCompare(right[0][key])*s <= 0) {
            result.push(left.shift());
        } else {
            result.push(right.shift());
        }
    }

    while (left.length)
        result.push(left.shift());

    while (right.length)
        result.push(right.shift());

    return result;
}
function sortJson(key){
	if(prevKey == key){
		prevKey ="";
		json = mergeSort(json, key, -1);
	}else{
		prevKey = key;
		json = mergeSort(json, key, 1);
	}
	writeList();
}


function writeList(){
	var sarr = {name:"이름", student_id:"학번", major:"전공",location:"활동 지역",rank:"등급",entry:"활동 여부"};

	var str = "<table>";
	str +=	"<thead>";
	str +=	"<tr>";
	for(key in json[0]){
		str += "<th onclick=\"sortJson('"+key+"')\">"+sarr[key]+"</th>";
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
}

function writeChart(json){

}


function SwitchChart(){
	$(".chart").show();
	$(".memberList").hide();
}

function SwitchList(){
	$(".chart").hide();
	$(".memberList").show();
}