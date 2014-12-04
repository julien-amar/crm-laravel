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
});