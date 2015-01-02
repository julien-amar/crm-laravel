$(document).ready(function() {
	// Changing dropdown value, changes dropdown text
	$(".dropdown .dropdown-menu li a").on('click', function(){
		var selText = $(this).html();
		var selValue = $(this).attr('data-value');
		
		if (selValue === undefined) {
			return;
		}
		
		var $dropdown = $(this).parents('.dropdown').find('.dropdown-toggle');

		$dropdown.html(selText + ' <span class="caret"></span>');
		
		var valueSelector = $dropdown.attr('data-hidden-target');

		$(valueSelector).val(selValue).change();
	});

	// Restore selected value as default dropdown text.
	$('.dropdown').each(function (index, element) {
		var $dropdown = $(element).find('.dropdown-toggle');
		var valueSelector = $dropdown.attr('data-hidden-target');
		var selValue = $(valueSelector).val();
		
		if (selValue) {
			var $selItem = $(element).find('a[data-value="' + selValue + '"]');
			
			$dropdown.html($selItem.html() + ' <span class="caret"></span>');
		}
	});

	// Popover on hover
	$('[data-toggle=popover]').popover({
		trigger: 'hover'
	})

	// Datepicker (formats)
	var datePickerSelector = '.input-group.date[data-datepicker=date]';
	$(datePickerSelector).datetimepicker({
        language: 'fr',
        pickTime: false,
        format: 'YYYY-MM-DD'
    });

	$(datePickerSelector + ' input.form-control').each(function (i) {
		if (this.value)
			this.value = moment(this.value, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD");
	});

	var dateTimePickerSelector = '.input-group.date[data-datepicker=datetime]';
	$(dateTimePickerSelector).datetimepicker({
        language: 'fr',
        pickTime: true,
        format: 'YYYY-MM-DD HH:mm:ss'
    });

	// Datepicker (clear)
	function clearDatepicker() {
		$(this).parents(dateTimePickerSelector).find('input').val('');
		$(this).parents(datePickerSelector).find('input').val('');
	}

	$(datePickerSelector + ' .datepickerclear').click(clearDatepicker);
	$(dateTimePickerSelector + ' .datepickerclear').click(clearDatepicker);
});