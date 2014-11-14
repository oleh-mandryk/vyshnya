$(document).ready(function()

{
$('#search .left, #search input, #search textarea, #search select').focus(function(){

$(this).parents('.row').addClass("over");

}).blur(function(){

$(this).parents('.row').removeClass("over");

});

});