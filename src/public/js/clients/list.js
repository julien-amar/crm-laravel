$(document).ready(function() {
	var lastSubmitedForm = undefined;
	var searchUrl = $('#client-search').attr('action');

	// Search
	function onSubmitSearch(event) {
		processSubmitSearch(event, event.target, searchUrl);

		lastSubmitedForm = event.target;
	}

	function processSubmitSearch(event, form, url) {
		
		event.preventDefault();

		dataString = $(form).serialize();

		$("#client-result").loader();

        $.ajax({
	        type: "GET",
	        url: url,
	        data: dataString
        })
        .done(function(data) {
                $("#client-result").html(data);
		})
		.fail(function(request, error) {
                $("#client-result").html(data);
		});
	}

	$('#client-search').submit(onSubmitSearch);
	$('#client-quick-search').submit(onSubmitSearch);

	$('#client-result').on('click', '.pagination li a', function (event) {
		processSubmitSearch(event, lastSubmitedForm, this.href);
	});

	$('#client-search').submit();

	// Mailing selection
	function handleSelection(event, $checkbox) {

		var value = $checkbox.val();
		var values = $('#clients').val().split(',');
		var checkState = $checkbox.prop('checked') ? true : false;

		if (checkState) {
			values.push(value);
		} else {
			values = values.filter(function (x) {
				return x && x != value;
			});
		}

		$('#clients').val(values.join(','));
	}

	$('#client-result').on('click', 'tr', function(event) {
        if (event.target.type !== 'checkbox') {
        	console.log('checkbox had been checked.');
            $(':checkbox', this).trigger('click');
        	console.log('checkbox had been checked fired.');
        } else {
        	console.log('checkbox had been checked handle.');
            handleSelection(event, $(event.target));
        	console.log('checkbox had been checked handled.');
        }
    });
});