$(document).ready(function(){
	$(".nav .menu").mouseover(
		function(){
			$(".nav .select_menu").parent().parent().hide();
			$(".nav .select_menu").parent().parent().prev().removeClass("hover");
			$(this).find(".detail_menu").show();
			$(this).find(".main_menu").addClass("hover");
		}
	).mouseout(function(){
			$(this).find(".detail_menu").hide();
			$(this).find(".main_menu").removeClass("hover");
			$(".nav .select_menu").parent().parent().show();
			$(".nav .select_menu").parent().parent().prev().addClass("hover");
		}
	);

});

function select_menu(menu){
	console.log(menu);
	$(".nav #"+menu).addClass("select_menu");
	$(".nav .select_menu").parent().parent().show();
	$(".nav .select_menu").parent().parent().prev().addClass("hover");
	
}