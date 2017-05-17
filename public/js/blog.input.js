$(document).ready(function(){
   $("#my_form").on("submit", function () {
		var hvalue = $('.editor-wrapper').text();
		$(this).append("<input type='hidden' name='content' value=' " + hvalue + " '/>");
	});
});