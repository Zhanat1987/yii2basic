jQuery.fn.live = function (types, data, fn) {
    jQuery(this.context).on(types,this.selector,data,fn);
    return this;
};
jQuery(document).ready(function () {
    // Set current page
    App.setPage("widgets_box");
    // Initialise plugins and elements
    App.init();
    initSelect2();
    checkboxSingle();
    tbDatePicker();
    appAjaxStart();
    appAjaxStop();
    sidebarMenu();
    tooltipPopover();
    deleteFromGrid();
    tbDateTimePicker();
    reloadPjax();
    modalBackdrop();
});
function appAjaxStart()
{
    $(document).ajaxStart(function() {
        var width = $(document).width();
        var height = $(document).height();
        $('.modal-loading-bg').css({'display':'block', 'opacity':0.2,
            'width':width + 'px', 'height':height + 'px'});
        $('.modal-loading').css({'display':'block', 'opacity':1});
    });
}
function appAjaxStop()
{
    $(document).ajaxStop(function() {
        $('.modal-loading-bg, .modal-loading').css({'display':'none'});
        initSelect2();
        checkboxSingle();
        tbDatePicker();
        deleteFromGrid();
        tooltipPopover();
        tbDateTimePicker();
        modalBackdrop();
    });
}
function checkboxSingle()
{
    $('input[name="checkboxSingle[]"]').live('click', function() {
        var v = $(this).prop('checked');
        $('input[name="checkboxSingle[]"]').prop('checked', false);
        $(this).parents('.grid-view').find('tr').removeClass('checkboxSingleTr');
        $(this).prop('checked', v);
        if (v) {
            $(this).parent().parent().addClass('checkboxSingleTr');
        }
    });
}
function tbDatePicker()
{
    $('.dateFilter input, .tbDatePicker').datetimepicker({
        language: 'ru',
        pickTime: false,
        useCurrent: false,
        format: 'DD/MM/YYYY'
    });
}
function tbDateTimePicker()
{
    $('.tbDateTimePicker').datetimepicker({
        language: 'ru',
        pickTime: true,
        useMinutes: true,
        minuteStepping: 1,
        pick12HourFormat: false,
        useCurrent: true,
        format: 'DD/MM/YYYY (HH:mm)'
    });
    $('.tbDateTimePicker').live('keydown', function() {
        return false;
    });
}
function initSelect2()
{
    if ($('.select2').length) {
        $('.select2').select2(
            {
                allowClear: true
            }
        );
    }
}
function sidebarMenu()
{
    $('#sidebar ul li a[href="' + window.location.pathname +
        '"]').parent('li').addClass('active').parents('li.has-sub').addClass('active');
    $('.has-sub-sub.active').addClass('open');
    $('.has-sub-sub > ul.sub-sub > li.active').parent().parent().addClass('open').addClass('active');
    $('.has-sub-sub.open > ul.sub-sub').css({'display':'block'});
}
function tooltipPopover()
{
    $('.grid-view a').each(function() {
        $(this).attr('data-toggle', 'tooltip');
    });
    $("[data-toggle='tooltip']").tooltip();
    $("[data-toggle='popover']").popover();
}
function deleteFromGrid()
{
    $('.deleteFromGrid').live('click', function() {
        if (confirm($(this).attr('confirm'))) {
            var $filters = $(this).parents().find('.grid-view .filters');
            $.ajax({
                type: 'POST',
                url: $(this).attr('url'),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'ok') {
                        if ($filters.find('input:eq(0)')) {
                            $filters.find('input:eq(0)').trigger("change");
                        } else if ($filters.find('select:eq(0)')) {
                            $filters.find('select:eq(0)').trigger("change");
                        }
                    } else {
                        console.log(response.msg);
                    }
                }
            });
        }
        return false;
    });
}
function onlyDigits(input)
{
    $(input).val($(input).val().replace(/[^\d,]/g, ''));
}
// onkeyup
function notMore(input)
{
	onlyDigits(input);
	var val = parseInt($(input).val());
	var max = parseInt($(input).attr('max'));
	if (val > max) {
		$(input).val(max);
	}
}
function disabledForm(form, url)
{
    $('#' + form + ' input, #' + form + ' select').prop('disabled', true);
    $('#' + form + ' input, #' + form + ' select').attr('readonly', 'readonly');
    $('#' + form + ' select').select2('readonly', true);
    $('#' + form + ' .form-group:last').html('<a class="btn btn-info" href="' + url + '">Вернуться</a>');
    $('#' + form + ' span.input-group-btn').remove();
}
function reloadPjax()
{
    $(document).on('pjax:complete', function(xhr, textStatus) {
        $('#' + xhr.target.id + ' tr.filters td:eq(0)').html('<a href="#" class="reloadPjax" ' +
            'title="Показать все" data-toggle="tooltip">' +
            '<i class="fa fa-refresh"></i></a>');
        if ($('select.select2inBox').length) {
            /**
             * Uncaught query function not defined for Select2 s2id
             * http://stackoverflow.com/questions/14483348/
             * query-function-not-defined-for-select2-undefined-error
             */
            $('select.select2inBox').select2();
        }
        if ($('select.select2').length) {
            $('select.select2').select2();
        }
        tooltipPopover();
    });
    $(document).on('pjax:start', function(xhr, textStatus) {
        $.pjax.defaults.timeout = 5000;
    });
    $('.reloadPjax').live('click', function() {
        var id = $(this).parents('div[id$="-pjax"]').attr('id');
        var id2 = $(this).parents('.grid-view').parent().attr('id');
        $.pjax.reload('#' + id2,
            {
                "push":true,
                "replace":false,
                "timeout":5000,
                "scrollTo":false,
                url: window.location.pathname
            }
        );
        return false;
    });
}
function noKeyDown(element)
{
    $(element).live('keydown', function (event) {
        event.preventDefault();
    });
}
function modalBackdrop()
{
    $('.modal').on('hide.bs.modal', function (e) {
        $('.modal-backdrop').remove();
    });
//    $('.modal-backdrop').live('click', function() {
//        $(this).remove();
//        $('.modal[aria-hidden=false]:eq(0)').modal('hide');
//    });
}
function trim(str, charlist)
{
    var whitespace, l = 0,
        i = 0;
    str += '';
    if (!charlist) {
        whitespace =
            ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007' +
                '\u2008\u2009\u200a\u200b\u2028\u2029\u3000';
    } else {
        // preg_quote custom list
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
    }
    l = str.length;
    for (i = 0; i < l; i++) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    }
    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}