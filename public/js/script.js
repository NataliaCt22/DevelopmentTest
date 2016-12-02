$(document).ready(function() {
	
	$('#form').submit(function(e) {
		e.preventDefault();
  	});	
	
	$('#submit').click(function() {
		
		var numberOne = $('#numberOne').val();
		var numberTwo = $('#numberTwo').val();
		var token = $('#token').val();

		$.ajax({

			type: "post",
			url: "/add",
			headers: { 'X-CSRF-TOKEN': token },
			data: { numberOne, numberTwo },
			success: function(resp) 
			{
				if (resp != "") 
				{	$('#resultContainer').show();
					$('#result').empty();
					$('#result').append("<h4>"+resp+"</h4>");          
				}
			}
		});
	});
});