$(document).ready(function(){
		//Ganti gambar kalau di hover
		$("#child1").hover(
	    function(){
          var pic = $("#child1").data('field-id');
	        $("#parent").attr('src',pic)
						$("#child1").css('border','solid 5px');
						$("#child2").css('border','hidden 0px');
						$("#child3").css('border','hidden 0px');
	    }
	);
	$("#child2").hover(
		function(){
				var pic = $("#child2").data('field-id');
				$("#parent").attr('src',pic)
				$("#child2").css('border','solid 5px');
				$("#child1").css('border','hidden 0px');
				$("#child3").css('border','hidden 0px');
		}
	);
	$("#child3").hover(
	function(){
			var pic = $("#child3").data('field-id');
			$("#parent").attr('src',pic)
			$("#child3").css('border','solid 5px');
			$("#child2").css('border','hidden 0px');
			$("#child1").css('border','hidden 0px');
	}
	);
});
