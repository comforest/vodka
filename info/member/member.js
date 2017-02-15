document.write("<script src='/static/javascript/sortTable.js'></script>");

$(document).ready(function(){
	
	addKeyList("name","이름");
	addKeyList("student_id","학번");
	addKeyList("colleage","단과대");
	addKeyList("major","전공");
	addKeyList("location","활동지역");
	addKeyList("rank","등급");
	addKeyList("gender","성별");
	addKeyList("phone","전화번호");
	addKeyList("class","기수");
	addKeyList("note","비고");
	// var str = "<a onclick=\"SwitchChart()\">차트 보기</a>";

	getData("getMember.php");
});

function SwitchChart(){
	$("#chart").show();
	$("#memberList").hide();
}

function SwitchList(){
	$("#chart").hide();
	$("#memberList").show();
}