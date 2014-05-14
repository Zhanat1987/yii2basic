jQuery.fn.live = function (types, data, fn) {
    jQuery(this.context).on(types,this.selector,data,fn);
    return this;
};
jQuery(document).ready(function () {
    App.setPage("widgets_box");  //Set current page
    App.init(); //Initialise plugins and elements

//    console.log(window.location.pathname);
//    console.log(window.location.host);
//    console.log(window.location.href);
//    console.log(window.location.port);
//    console.log(window.location.protocol);
//    console.log(window.location.hash);
    /**
     * текущий пункт меню
     */
    $('#sidebar ul li a[href="' + window.location.pathname +
        '"]').parent('li').addClass('active').parents('li.has-sub').addClass('active');
//    $.pjax.reload({container:'#w0'});
    $('.select2').select2();
    checkboxSingle();
    uiDatepicker();
});
jQuery(document).ajaxStop(function() {
    $('.select2').select2();
    checkboxSingle();
    uiDatepicker();
});
function checkboxSingle()
{
    $('input[name="checkboxSingle[]"]').bind('click', function() {
        var v = $(this).prop('checked');
        $('input[name="checkboxSingle[]"]').prop('checked', false);
        $(this).prop('checked', v);
    });
}
function uiDatepicker()
{
//    $('.dateFilter input').datepicker(
//        $.extend({showMonthAfterYear:false},
//            jQuery.datepicker.regional['ru'],
//            {
//                'dateFormat':'dd/mm/yy',
//                'changeYear':true,
//                'changeMonth':true,
//                'showAnim':'slideDown',
//                'showWeek':true,
//                'showButtonPanel':false,
//                'yearRange':'1900'
//            }
//        )
//    );
    $('.dateFilter input').datepicker();
}