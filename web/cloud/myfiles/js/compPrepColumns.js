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
        $('.columns').text($(this).attr('text')).attr('sub', $(this).attr('sub')).attr('grid', $(this).attr('grid'));
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
                    reloadPjax(grid);
                    console.log(response.msg);
                } else if (response.status == 'error') {
                    console.log(response.msg);
                }
            }
        });
        return false;
    });
}
function reloadPjax(grid)
{
    if ($('#' + grid + ' tr.filters input:eq(0)').length) {
        $('#' + grid + ' tr.filters input:eq(0)').trigger('change');
    } else if ($('#' + grid + ' tr.filters select:eq(0)').length) {
        $('#' + grid + ' tr.filters select:eq(0)').trigger('change');
    } else {
//        $.pjax.reload('#' + $('#' + grid).parent().attr('id'),
//            {
//                push:true,
//                replace:false,
//                timeout:5000,
//                scrollTo:false,
//                url: window.location.pathname
//            }
//        );
    }
}

function reloadPjaxCPC()
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
$(document).ready(function() {
    columns();
    reloadPjaxCPC();
});