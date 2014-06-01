function mkb10()
{
    $('.mkb10Span').live('click', function() {
        $.ajax({
            type: 'GET',
            url: '/catalog/mkb10/modal',
            dataType: 'html',
            success: function(data) {
                $('.mkb10SpanM .modal-body').html(data);
                $('.mkb10SpanM').modal();
            }
        });
        return false;
    });
    $('.mkb10Primary').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $('#' + $modal.attr('id')).select2('destroy').select2().select2('val', $checkbox.val());
        }
        $(this).next('.btn-danger').click();
        return false;
    });
    $('.mkb10SpanM').on('hide.bs.modal', function (e) {
        window.history.pushState('string', 'Title', $('.requestUrl').text());
    });
    
}
jQuery(document).ready(function () {
    mkb10();
});