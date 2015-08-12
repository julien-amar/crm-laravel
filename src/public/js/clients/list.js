$(document).ready(function() {
	var lastSubmitedForm = undefined;
	var searchUrl = $('#client-search').attr('action');

	// Search
    function applySelectionOnView(data)
    {
        var currentSelection = $('#clients').val();
        var values = currentSelection.split(',');

        values = values.filter(function (x) {
            return x != '';
        });

        $("#client-result").html(data);

        values.forEach(function (e) {
            $("#client-result").find('#clients-' + e).prop('checked', 'checked');
        });

        $('#clients').trigger('mailing.selection.changed');
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
            applySelectionOnView(data);
        })
        .fail(function(request, error) {
            alert('An error occured : ' + error);
        });
    }

	function onSubmitSearch(event) {
		processSubmitSearch(event, event.target, searchUrl);

		lastSubmitedForm = event.target;
	}

    function onClickSearch(event, button) {
        var form = $(button).parent('form');

        retrieveSelection(function() {
            $(form).submit();
        });
    }

    $('#client-search').submit(onSubmitSearch);
    $('#client-quick-search').submit(onSubmitSearch);

    $('#client-search input[type=submit]').on('click', onClickSearch);
    $('#client-quick-search button[type=submit]').on('click', onClickSearch);

    // Paggination
	$('#client-result').on('click', '.pagination li a', function (event) {
		processSubmitSearch(event, lastSubmitedForm, this.href);
	});

    // Counter update (Mailing selection)
    $('#clients').on('mailing.selection.changed', function () {
        var currentSelection = $('#clients').val();
        var values = currentSelection.split(',');

        values = values.filter(function (x) {
            return x != '';
        });

        var $mailingButton = $('#btn-mailing');
        var defaultText = $mailingButton.attr('data-counter');

        if (values.length) {
            $mailingButton.html(defaultText + ' (' + values.length + ')');
            $mailingButton.prop('disabled', false);
        } else {
            $mailingButton.html(defaultText);
            $mailingButton.prop('disabled', true);
        }
    });

    // Mailing clients retrieval
    function retrieveSelection(callback)
    {
        var url = $('#client-result').attr('data-check');
        var data = $('#client-search').serialize();

        $.post(url, data)
            .done(function (data) {
                var values = $.map(data, function (x) {
                    return x.id;
                });

                var clients = values.join(',');

                $('#clients').val(clients).trigger('mailing.selection.changed');

                if (callback)
                    callback();
            });
    }

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

		$('#clients').val(clients).trigger('mailing.selection.changed');
	}

	$('#client-result').on('click', 'tr', function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        } else {
            handleSelection(event, $(event.target));
        }
    });

    // Clear Selection
    $('#client-result').on('click', '#clear-selection', function(event) {
        $('#client-result').find(':checkbox').attr('checked', false);

        $('#clients').val('').trigger('mailing.selection.changed');

        $(this).hide();
    });

    // Add mailing file
    $('#add-mailing').on('click', function () {
    	var target = $(this).attr('data-target');
    	var templateName = $(this).attr('data-template');
    	var template = $('#template-' + templateName + ' li');

    	$(template).clone().appendTo($(target));
    });

    // Set mailing operation
    $('.operation_dropdown_entry a').on('click', function () {
        var target = $(this).attr('data-value');
        var template = $('#' + target).html();

        tinyMCE.get('message').setContent(template);
    });

    // Trigger client search on page loading
    $('#client-search input[type=submit]').click();
});