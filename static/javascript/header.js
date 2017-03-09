$(document).ready(function(){
	$(".nav .menu").mouseover(function(){
		$(".nav .detail_menu").hide();
		$(".nav .main_menu").removeClass("hover");
		$(this).find(".detail_menu").show();
		$(this).find(".main_menu").addClass("hover");
	});


	$("body>aside").mouseleave(function(){
		$(".nav .detail_menu").hide();
		$(".nav .main_menu").removeClass("hover");
		$(".nav .select_menu").parent().parent().show();
		$(".nav .select_menu").parent().parent().prev().addClass("hover");
	});
});

function select_menu(menu){
	$(".nav #"+menu).addClass("select_menu");
	$(".nav .select_menu").parent().parent().show();
	$(".nav .select_menu").parent().parent().prev().addClass("hover");	
}