function columns()
{
    $('.columns').live('click', function() {
        $('.columnsM .modal-title').text($(this).text());
        if ($(this).attr('sub') == 'kk') {
            $('.columnsMKK').show();
            $('.columnsMPK').hide();
        } else {
            $('.columnsMPK').show();
            $('.columnsMKK').hide();
        }
        $('.columnsM').modal();
    });
    $('.columnsUl a').live('click', function() {
        $('.columns').text($(this).attr('text')).attr('sub', $(this).attr('sub'));
    });
    $('.columnsM .btn-primary').live('click', function() {
        var columns = '';
        $('.columnsM input[type=checkbox]').each(function() {
            if ($(this).is(':checked')) {
                columns += $(this).val() + ',';
            }
        });
        $.ajax({
            type: 'GET',
            url: '/user/deny/comp-prep-columns',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data: {
                'columns' : trim(columns, ','),
                'module' : $(this).attr('module')
            },
            success: function(response) {
                $('.columnsM').modal('hide');
                if (response.status == 'ok') {
                    $('.reloadPjax').click();
                    console.log(response.msg);
                } else if (response.status == 'error') {
                    console.log(response.msg);
                }
            }
        });
        return false;
    });
}
$(document).ready(function() {
    columns();
});