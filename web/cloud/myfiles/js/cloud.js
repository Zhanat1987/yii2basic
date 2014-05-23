jQuery.fn.live = function (types, data, fn) {
    jQuery(this.context).on(types,this.selector,data,fn);
    return this;
};
jQuery(document).ready(function () {
    // Set current page
    App.setPage("widgets_box");
    // Initialise plugins and elements
    App.init();
    /**
     * текущий пункт меню
     */
    $('#sidebar ul li a[href="' + window.location.pathname +
        '"]').parent('li').addClass('active').parents('li.has-sub').addClass('active');
//    $.pjax.reload({container:'#w0'});
    initSelect2();
    checkboxSingle();
    tbDatePicker();
    appAjaxStart();
    appAjaxStop();
    sidebarMenu();
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
    $('.dateFilter input').datetimepicker({
        language: 'ru',
        pickTime: false,
        format: 'DD/MM/YYYY'
    });
}
function initSelect2()
{
    if ($('.select2').length) {
        $('.select2').select2();
    }
}
function sidebarMenu()
{
    $('.has-sub-sub.active').addClass('open');
    $('.has-sub-sub > ul.sub-sub > li.active').parent().parent().addClass('open').addClass('active');
    $('.has-sub-sub.open > ul.sub-sub').css({'display':'block'});
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