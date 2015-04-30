$(document).ready(function(){
	$("#brand-image").click(function(){
		window.location.href="index.php";
	});

	$("input").each(function(){
		$(this).attr("autocomplete", "off");
	});
});