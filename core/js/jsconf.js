$(document).ready(function(){
	$(".menu_acs").next("div").hide();
	$(".menu_acs").mouseover(function(){
		if($(this).next("div").is(":hidden"))
		{
			$(".menu_acs").next("div:visible").slideUp();
			$(this).next("div").slideDown();
		}
		if($(this).next("div").is(":visible"))
			{
							$("menu_acs").next("div").slideDown();
			}
	});
		$(".cachetab").next("div").hide();
	$(".cachetab").mouseover(function(){
		if($(this).next("div").is(":hidden"))
		{
			$(".cachetab").next("div:hidden").slideUp();
			$(this).next("div:hidden").slideDown();
		}
		if($(this).next("div").mouseover.is(":visible"))
			{
							$(".cachetab").next("div:visible").slideUp();
			}


	});


});
