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

		$dropdown.attr('data-selection', selValue);
	});

	// Restore selected value as default dropdown text.
	$('.dropdown').each(function (index, element) {
		var $dropdown = $(element).find('.dropdown-toggle');

		var valueSelector = $dropdown.attr('data-hidden-target');
		var selValue = $(valueSelector).val();
		
		if (selValue) {
			var $selItem = $(element).find('a[data-value="' + selValue + '"]');
			
			$dropdown.html($selItem.html() + ' <span class="caret"></span>');

			$dropdown.attr('data-selection', selValue);
		}
	});

	// Multi selection dropdown component
	$(".dropdown .dropdown-menu li a[rel=nofollow]").on('click', function(e) {
		var $target = $(e.target);
		var $checkbox = $(this).find(':checkbox');

		if ($checkbox && !$target.is(':checkbox')) {
			$checkbox.prop("checked", !$checkbox.prop("checked"));
		}

		e.stopPropagation();
	});

	// Popover on hover
	$('[data-toggle=popover]').popover({
		trigger: 'hover'
	});

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

	// Relative time
	$('.relative-time').each(function (i) {
		$(this).html(moment($(this).html(), "YYYY-MM-DD HH:mm:ss").fromNow());
	});

	// Default ajax behavior on DOM elements
	$('[data-toggle=ajax]').each(function (i) {
		var target = $(this);
		var targetEvent = $(this).attr('data-event');
		var targetData = $(this).attr('data-data');
		var targetMethod = $(this).attr('data-method');
		var targetTarget = $(this).attr('data-target');

		target.on(targetEvent, function (e) {
			$.ajax({
				url: targetTarget,
				method: targetMethod,
				data: $(targetData).serialize(),
				dataType: "jsonp"
			});

			e.stopPropagation();
		});
	});

	// Default redirection behavior on DOM elements
	$('[data-toggle=redirect]').each(function (i) {
		var target = $(this);
		var targetEvent = $(this).attr('data-event');
		var targetData = $(this).attr('data-data');
		var targetMethod = $(this).attr('data-method');
		var targetTarget = $(this).attr('data-target');

		target.on(targetEvent, function (e) {
			var data = $(targetData).serialize();
			var uri = targetTarget + '?' + data;

			window.location.href = uri;

			e.stopPropagation();
		});
	});
});