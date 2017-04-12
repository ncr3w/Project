
$(document).ready(function(){
	
	$("#regency_name").hide();
	$("#district_name").hide();

   $("#province_name").on("change", function(){
	    $baseurl = window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
		$.getJSON( $baseurl + '/location/regencies/' + $("#province_name").val(), function( ) {
			console.log( "success" );
		})
		.done(function(json) {
			$("#regency_name").empty();
			$.each(json.data, function(i , field){
				var str = field.regency_name;
				var id = field.id;
				var opt = $("<option></option>", { "text" : str, value : id });
				$("#regency_name").append(opt);			
			});
			$("#regency_name").show();
			$("#regency_placehoder").hide();
		})
		.fail(function( jqxhr, textStatus, error ) {
			var err = textStatus + ", " + error;
			console.log( "Request Failed: " + err );
		});	
	});
	
	$("#regency_name").on("change", function(){
	    $baseurl = window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
		console.log($baseurl+ '/location/districts/' + $("#regency_name").val());
		$.getJSON( $baseurl + '/location/districts/' + $("#regency_name").val(), function( ) {
			console.log( "success" );
		})
		.done(function(json) {
			$("#district_name").empty();
			$.each(json.data, function(i , field){
				var str = field.district_name;
				var id = field.id;
				var opt = $("<option></option>", { "text" : str, value : id });
				$("#district_name").append(opt);			
			});
			$("#district_name").show();
			$("#district_placehoder").hide();
		})
		.fail(function( jqxhr, textStatus, error ) {
			var err = textStatus + ", " + error;
			console.log( "Request Failed: " + err );
		});	
	});
});

