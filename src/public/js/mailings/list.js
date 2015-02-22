$(document).ready(function() {
	function loadResult(url, dataString)
	{
		$("#mailing-result").loader();

        $.ajax({
	        type: "GET",
	        url: url,
	        data: dataString
        })
        .done(function(data) {
                $("#mailing-result").html(data);
		})
		.fail(function(request, error) {
                $("#mailing-result").html(data);
		});
	}

	function processSubmitSearch(event, form, url) {
		
		event.preventDefault();

		dataString = $(form).serialize();

		loadResult(url, dataString);
	}

	// page navigation
	$('#mailing-result').on('click', '.pagination li a', function (event) {
		processSubmitSearch(event, lastSubmitedForm, this.href);
	});

	loadResult(resultUrl);
});