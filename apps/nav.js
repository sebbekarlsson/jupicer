
$(document).ready(function(){

	var old_lis = $("#top-nav .right").html();
	var lis = $("#top-nav .right li");
	
	var selection = "<select id='nav-select' onchange='location = this.options[this.selectedIndex].value;' >";
	selection += "<option default>Menu</option>";
				
	lis.each(function(){
		var a = $(this).find("a");
		var href = $(a).attr("href");
		var text = $(a).text();
		
		selection += "<option value='"+href+"' >"+text+"</option>";
	});

	selection += "</select>";

	var is_selection = false;
	var is_buttons = true;

	setInterval(function(){
		
		var window_width = $(window).width();

		if(window_width <= 700){

			if(is_selection == false){

				//$("#search-input").hide();
				$(".hide-small").hide();
				$("#top-nav .right").html(selection);

				is_selection = true;
				is_buttons = false;

			}

		}else{

			if(is_buttons == false){
			
				//$("#search-input").fadeIn();
				$(".hide-small").fadeIn();
				$("#top-nav .right").html(old_lis);
				
				is_buttons = true;
				is_selection = false;

			}
		}
	}, 1000);
});