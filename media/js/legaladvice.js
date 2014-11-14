$(document).ready(function(){
	$(".legaladvice ul").hide();
	$(".legaladvice ul li:odd");
	$(".legaladvice p span").click(function(){
		$(this).parent().next().slideToggle();
	});
});