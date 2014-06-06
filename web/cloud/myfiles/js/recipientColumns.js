function columns()
{
    $('.columns').live('click', function() {
        $('.columnsM .modal-title').text($(this).text());
        $('.columnsM').modal();
    });
    $('.columnsM .btn-primary').live('click', function() {
        var columns = '';
        $('.columnsM input[type=checkbox]').each(function() {
            if ($(this).is(':checked')) {
                columns += $(this).val() + ',';
            }
        });
        var grid = $('.columns').attr('grid');
        $.ajax({
            type: 'GET',
            url: '/recipient/info/columns',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data: {
                'columns' : trim(columns, ',')
            },
            success: function(response) {
                $('.columnsM').modal('hide');
                if (response.status == 'ok') {
                    reloadPjaxCPC(grid);
                    console.log(response.msg);
                } else if (response.status == 'error') {
                    console.log(response.msg);
                }
            }
        });
        return false;
    });
}
function reloadPjaxCPC(grid)
{
    if ($('#' + grid + ' tr.filters input:eq(0)').length) {
        $('#' + grid + ' tr.filters input:eq(0)').trigger('change');
    } else if ($('#' + grid + ' tr.filters select:eq(0)').length) {
        $('#' + grid + ' tr.filters select:eq(0)').trigger('change');
    } else {
        $.pjax.reload('#' + $('#' + grid).parent().attr('id'),
            {
                push:true,
                replace:false,
                timeout:5000,
                scrollTo:false,
                url: window.location.pathname
            }
        );
    }
}
$(document).ready(function() {
    columns();
});