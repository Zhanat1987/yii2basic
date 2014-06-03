function typeSend()
{
    $('.typeSend').live('change', function() {
        $('.typeSend' + $('.blood-storage-index .nav-tabs li.active').index()
            ).val($(this).val()).trigger('change');
    });
}
function returnToBloodStorage()
{
    $('.return').live('click', function() {
        if (confirm($(this).attr('confirm'))) {
            var $input = $(this).parents().find('.grid-view tr.filters input:eq(0)');
            $.ajax({
                type: 'GET',
                url: '/bloodstorage/blood-storage/return',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: {
                    'id' : $(this).attr('id')
                },
                success: function(response) {
                    if (response.status == 'ok') {
                        $input.trigger('change');
                    } else if (response.status == 'error') {
                        console.log(response.msg);
                    }
                }
            });
        }
        return false;
    });
}
$(document).ready(function() {
    typeSend();
    returnToBloodStorage();
});