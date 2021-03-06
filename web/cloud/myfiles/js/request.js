function rbRemove()
{
    $('.rbRemove').live('click', function() {
        if ($(this).parent().parent().parent().find('tr').size() > 4) {
            $(this).parent().parent().remove();
        }
    });
    $('.rbkTrReplace').live('click', function() {
        $(this).parent().parent().html($('.rbkTr').html());
        $('#table-tab-kk .rbRemove:eq(1)').removeClass('rbRemove').addClass('rbkTrReplace');
        $('#table-tab-kk tr:eq(2) select').select2();
    });
    $('.rbpTrReplace').live('click', function() {
        $(this).parent().parent().html($('.rbpTr').html());
        $('#table-tab-pk .rbRemove:eq(1)').removeClass('rbRemove').addClass('rbpTrReplace');
        $('#table-tab-pk tr:eq(2) select').select2();
    });
}
function rbkAdd()
{
    $('#table-tab-kk tr:last input, #table-tab-kk tr:last select').live('change', function() {
        $('#table-tab-kk').append('<tr>' + $('.rbkTr').html() + '</tr>');
        $('#table-tab-kk tr:last select').select2();
    });
}
function rbpAdd()
{
    $('#table-tab-pk tr:last input, #table-tab-pk tr:last select').live('change', function() {
        $('#table-tab-pk').append('<tr>' + $('.rbpTr').html() + '</tr>');
        $('#table-tab-pk tr:last select').select2();
    });
}
function rbDelete()
{
    $('.rbDelete').live('click', function() {
        var id = parseInt($(this).attr('id'));
        if (id) {
            $.ajax({
                type: 'GET',
                url: '/request/request/delete-body',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: {
                    'id': id
                },
                success: function(response) {
                    console.log(response.status);
                    console.log(response.msg);
                }
            });
        }
        return false;
    });
}
$(document).ready(function () {
    rbRemove();
    rbkAdd();
    rbpAdd();
    rbDelete();
});