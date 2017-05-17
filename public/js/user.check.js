
$(document).ready(function(){
	
	$("#address_js").hide();
	$("#user_found").hide();

   $("#button_user_check").on("click", function(){
	    $baseurl = window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
		$.getJSON( $baseurl + '/location/address/' + $("#email_js").val(), function( ) {
			console.log( "success" );
		})		
		.done(function(json) {
			$("#address_js").empty();			
			if(json.check){
				$.each(json.data, function(i , field){
					var str = field.address;
					var id = field.id;
					var opt = $("<option></option>", { "text" : str, value : id });
					$("#address_js").append(opt);			
				});
				
				var user = json.user;	
				$("#user_js").val(user);
				
				$("#address_js").show();
				$("#address_placehoder").hide();
				$("#user_found").show();
			}
			else if(json.user == "-2"){			
				window.alert("user doesn't have a registered address");				
			}
			else{
				window.alert("user not found");	
				$("#user_found").hide();				
			}
		})
			.fail(function( jqxhr, textStatus, error ) {
			var err = textStatus + ", " + error;
			console.log( "Request Failed: " + err );
		});	
	});
});

