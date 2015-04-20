$(document).ready(function() {
    $('.dropdown .dropdown-menu li a').on('click', function () {
        var $dropdown = $(this).parents('.dropdown').find('.dropdown-toggle');
        var selValue = $(this).attr('data-value');

        if ($dropdown.attr('id') !== 'state_dropdown') {
            return;
        }

        if (selValue === undefined) {
            return;
        }

        if (selValue === 'Buyer') {
            $dropdown.removeClass('btn-warning');
            $dropdown.addClass('btn-info');
        } else if (selValue === 'Seller') {
            $dropdown.addClass('btn-warning');
            $dropdown.removeClass('btn-info');
        }
    });

    $('.dropdown').each(function (index, element) {
        var $dropdown = $(element).find('.dropdown-toggle');

        if ($dropdown.attr('id') !== 'state_dropdown') {
            return;
        }

        var valueSelector = $dropdown.attr('data-hidden-target');
        var selValue = $(valueSelector).val();
        
        if (selValue === 'Buyer') {
            $dropdown.removeClass('btn-warning');
            $dropdown.addClass('btn-info');
        } else if (selValue === 'Seller') {
            $dropdown.addClass('btn-warning');
            $dropdown.removeClass('btn-info');
        }
    });
});