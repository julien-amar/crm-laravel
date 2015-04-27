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

    // Paggination
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

		values = values.filter(function (x) {
			return x != '';
		});

		var clients = values.join(',');

		$('#clients').val(clients);

		if (clients)
			$('#btn-mailing').removeAttr('disabled');
		else
			$('#btn-mailing').attr('disabled', 'disabled');
	}

	$('#client-result').on('click', 'tr', function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        } else {
            handleSelection(event, $(event.target));
        }
    });

    // Mailing edition
    tinymce.init({
	    selector: '#message',
		height : 400
	 });

    // Add mailing file
    $('#add-mailing').on('click', function () {
    	var target = $(this).attr('data-target');
    	var templateName = $(this).attr('data-template');
    	var template = $('#template-' + templateName + ' li');

    	$(template).clone().appendTo($(target));
    });
});