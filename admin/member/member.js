document.write("<script src='/static/javascript/sortTable.js'></script>");

$(document).ready(function(){	

	$(".allCheck").change(function(){
		$(this).parent().parent().find("input[type='checkbox']").prop("checked", $(this).is(":checked"));
	});

	$("#filter td:nth-child(2) ~ td input[type='checkbox']").change(function(){
		var list = $(this).parent().parent().find("input[type='checkbox']:gt(0)");
		var b = true;
		$.each(list,function(k,v){
			if(!v.checked){
				b = false;
				return;
			}
		});
		if(b){
			$(this).parent().parent().find(".allCheck").prop("checked",true);
		}else{
			$(this).parent().parent().find(".allCheck").prop("checked",false);
		}
	});


	addKeyList("name","이름");
	addKeyList("student_id","학번");
	addKeyList("major","전공");
	addKeyList("location","활동 지역");
	addKeyList("rank", "등급");

	setAfterFunction(function(){
		$("#sortTable thead tr").prepend("<th><input type = 'checkbox'></input></th>");
		$("#sortTable tbody tr").prepend("<td><input type = 'checkbox'></input></td>");
		

		$("#sortTable thead tr:first-child input[type='checkbox']").change(function(){
			$("#sortTable tr input[type='checkbox']").prop("checked", $(this).is(":checked"));
		});
		$("#sortTable tbody tr input[type='checkbox']").change(function(){
			var index = $(this).parent().parent().index();
			json[index]["checked"] = $(this).is(":checked");
		});

		$.each(json,function(k,v){
			if(v["checked"] == true){
				$("#sortTable tbody tr:nth-child(" + k + ") input[type='checkbox']").prop("checked", true);
			}
		});
	});


	getData("getMember.php");


	$(".dropdown .dropbtn").click(function(){
		dropdownHide();
		$(this).next().show();
	})
});


function filter(){
	var arr1 = json_all;
	var arr2 = [];
	
	var list = $("#Slocation td:nth-child(2) ~ td input[type='checkbox']:checked");
	$.each(list,function(k,v){
		arr2 = $.merge(arr2, filterAction("location",v.name,arr1));
	});

	arr1 = arr2;
	arr2 = [];
	list = $("#Srank td:nth-child(2) ~ td input[type='checkbox']:checked");
	$.each(list,function(k,v){
		arr2 = $.merge(arr2, filterAction("rank",v.name,arr1));
	});
	json = arr2;

	writeList();
}
function filterAction(key, name, arr){
	var result = [];
	$.each(arr, function(k,v){
		if(v[key] == name){
			result.push(v);
		}
	});
	return result;
}



function getCheckedMemeber(){
	var list = $("#sortTable tbody input[type='checkbox']:checked");
	var arr = [];

    $.each(list,function(k,v){
    	var index = $(list[k]).parent().parent().index();
    	arr.push(json[index]["user_id"]);
    });
    return arr;
}

function findKeyIndex(key){
	var index = 0;
	for(k in sarr){
		if(k == key) break;
		++index;
	}
	return index;
}

function updateLocation(str){
	var arr = getCheckedMemeber();
	if(arr.length == 0){
		alert("변경하고자 하는 회원을 선택해주세요.");
		return;
	}
	$.ajax({
		url:"updateLocation.php",
		type:"post",
		data:{"list":arr,"location":str},
		success:function(data){
			if(data["status"] == "success"){
				var arr = data["message"];
				$.each(arr,function(key,value){
					var ch = false;
					$.each(json,function(k,v){
						if(v["user_id"] == value){
							json[k]["location"] = str;
							return;
						}
					});
				});
				writeList();
				alert("변경되었습니다.");
			}
		}
	});
}

function updateRank(rank){
	var arr = getCheckedMemeber();
	if(arr.length == 0){
		alert("변경하고자 하는 회원을 선택해주세요.");
		return;
	}
	var rankarr = ["해","달","별","구름"];
	$.ajax({
		url:"updateRank.php",
		type:"post",
		data:{"list":arr,"rank":rank},
		success:function(data){
			if(data["status"] == "success"){
				var arr = data["message"];
				$.each(arr,function(key,value){
					var ch = false;
					$.each(json,function(k,v){
						if(v["user_id"] == value){
							json[k]["rank"] = rankarr[rank-1];
							return;
						}
					});
				});
				writeList();
				alert("변경되었습니다.");
			}
		}
	});
}

function deleteMember(){
	confirm("정말로 회원들을 탈퇴시겠습니까? 탈퇴 시 해당 회원과 관련된 모든 데이터를 삭제합니다.")

	var arr = getCheckedMemeber();
	if(arr.length == 0){
		alert("삭제하고자 하는 회원을 선택해주세요.");
		return;
	}
	$.ajax({
		url:"deleteMember.php",
		type:"post",
		data:{"list":arr},
		success:function(data){
			if(data["status"] == "success"){
				var arr = data["message"];
				$.each(arr,function(key,value){
					var ch = false;
					$.each(json,function(k,v){
						if(v["user_id"] == value){
							ch = true;
						}
						if(json.length - 1 == k){
							json.splice(arr.length - 1, 1);
						}else if(ch){
							json[k] = json[k+1];
						}
					});
				});
				writeList();
				alert("삭제 되었습니다.");
			}
			// $("#sortTable tbody input[type='checkbox']:checked").parent().parent().remove();
		}
	});
}


// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
		dropdownHide();
	}
}

function dropdownHide(){
	var content = $(".dropdown .dropdown-content");
	$.each(content,function(k,v){
		$(content[k]).hide();
	});	
}