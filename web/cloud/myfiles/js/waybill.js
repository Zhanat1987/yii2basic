function request()
{
    $('.requestSpan').live('click', function() {
        $.ajax({
            type: 'GET',
            url: '/request/request/modal',
            dataType: 'html',
            success: function(data) {
                $('.requestM .modal-body').html(data);
                $('.requestM').modal();
                $('.requestM select').select2();
                if ($('#header-request').val()) {
                    $('.requestM input[type=checkbox][value=' +
                        $('#header-request').val() + ']').prop('checked', true);
                    $('.requestM tr[data-key=' +
                        $('#header-request').val() + ']').addClass('checkboxSingleTr');
                }
            }
        });
        return false;
    });
    $('.requestM .btn-primary').live('click', function() {
        var $checkbox = $('.requestM input[type=checkbox]:checked');
        if ($checkbox.length) {
            $('#header-request').val($checkbox.val());
            getInfo($checkbox.val());
        } else {
            $('.requestInfo, .requestResponse').html('');
            $('#header-request').val('');
        }
        $(this).next('.btn-danger').click();
        return false;
    });
    $('.requestM').on('hide.bs.modal', function (e) {
        window.history.pushState('string', 'Title', $('.requestUrl').text());
        if ($('#header-request').val()) {
            getInfo($('#header-request').val());
        }
    });
    $('.requestM input[type=checkbox]').live('change', function() {
        var $checkbox = $('.requestM input[type=checkbox]:checked');
        if ($checkbox.length) {
            getInfo($checkbox.val());
        } else {
            $('.requestInfo, .requestResponse').html('');
        }
    });
    if ($('#header-request').val()) {
        getInfo($('#header-request').val());
    }
}
function getInfo(id)
{
    $.ajax({
        type: 'GET',
        url: '/request/request/info',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        data: {
            'id' : id
        },
        success: function(response) {
            if (response.status == 'ok') {
                var html = '';
                if (response.kk.length) {
                    var kk = '<p><b>Компоненты</b></p>';
                    kk += '<table class="table table-bordered table-infoblood">';
                    kk += '<tr><td>Название</td><td>Группа крови</td>' +
                        '<td>Резус</td><td>Фенотип</td>' +
                        '<td>Объем</td><td>Количество</td></tr>';
                    for (var key in response.kk) {
                        kk += '<tr>';
                        kk += '<td>' + response.kk[key].name + '</td>';
                        kk += '<td>' + response.kk[key].blood_group + '</td>';
                        kk += '<td>' + response.kk[key].rh_factor + '</td>';
                        kk += '<td>' + response.kk[key].phenotype + '</td>';
                        kk += '<td>' + response.kk[key].volume + '</td>';
                        kk += '<td>' + response.kk[key].quantity + '</td>';
                        kk += '</tr>';
                    }
                    kk += '</table>';
                    html += kk;
                }
                if (response.pk.length) {
                    var pk = '<p><b>Препараты</b></p>';
                    pk += '<table class="table table-bordered table-infoblood">';
                    pk += '<tr><td>Название</td>' +
                        '<td>Объем</td><td>Количество</td></tr>';
                    for (var key in response.pk) {
                        pk += '<tr>';
                        pk += '<td>' + response.pk[key].name + '</td>';
                        pk += '<td>' + response.pk[key].volume + '</td>';
                        pk += '<td>' + response.pk[key].quantity + '</td>';
                        pk += '</tr>';
                    }
                    pk += '</table>';
                    html += pk;
                }
                $('.requestInfo, .requestResponse').html(html);
            } else if (response.status == 'error') {
                console.log(response.msg);
            }
        }
    });
}

jQuery(document).ready(function () {
    request();
});