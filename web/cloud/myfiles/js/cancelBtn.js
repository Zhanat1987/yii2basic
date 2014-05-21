function cancelBtn()
{
    $('.cancelBtn').live('click', function() {
        $('.cancelBtnM').modal();
    });
    $('a').live('click', function() {
        var href = $(this).attr('href');
        if (href.substr(0, 1) == '/') {
            $('.cancelBtnM').modal().attr('url', href);
            return false;
        }
    });
    $('.cancelBtnM .btn-primary').live('click', function() {
        window.location.href = $('.cancelBtnM').attr('url') ?
            $('.cancelBtnM').attr('url') : $('.cancelBtn').attr('url');
    });
    $('.cancelBtnM .btn-danger').live('click', function() {
        $('.cancelBtnM').removeAttr('url');
    });
}
jQuery(document).ready(function () {
    cancelBtn();
});