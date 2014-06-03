function typeSend()
{
    $('.typeSend').live('change', function() {
        $('.typeSend' + $('.blood-storage-index .nav-tabs li.active').index()
            ).val($(this).val()).trigger('change');
    });
}
$(document).ready(function() {
    typeSend();
});