function move()
{
    $('.move').live('click', function() {
        $('.moveM .id').val($(this).attr('id'));
        var quantity = $(this).attr('quantity');
        $('.moveM .count').val(quantity).attr('max', quantity);
        if (quantity > 1) {
            $('.countDiv').show();
        } else {
            $('.countDiv').hide();
        }
        $('.moveM select').select2();
        $('.moveM .defect, .moveM .organization').hide();
        $('.moveM').modal();
        return false;
    });
    $('.moveM .type').live('change', function() {
        var v = $(this).val();
        $('.hideSelects select').removeClass('visible');
        switch (v) {
            case '1' :
                $('.moveM .department').show();
                $('.moveM .defect, .moveM .organization').hide();
                break;
            case '2' :
                $('.moveM .defect').show();
                $('.moveM .department, .moveM .organization').hide();
                break;
            case '3' :
                $('.moveM .department, .moveM .defect, .moveM .organization').hide();
                break;
            case '4' :
                $('.moveM .organization').show();
                $('.moveM .defect, .moveM .department').hide();
                break;
        }
    });
    $('.moveM .btn-primary').live('click', function() {
        var id = $('.moveM .id').val();
        var type = $('.moveM select.type').val();
        switch (type) {
            case '1' :
                var catalog = $('.moveM select.department').val();
                break;
            case '2' :
                var catalog = $('.moveM select.defect').val();
                break;
            case '3' :
                var catalog = null;
                break;
            case '4' :
                var catalog = $('.moveM select.organization').val();
                break;
        }
        $.ajax({
            type: 'GET',
            url: '/bloodstorage/blood-storage/move',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data: {
                'id' : id,
                'type' : type,
                'catalog' : catalog,
                'date' : $('.moveM .tbDatePicker').val(),
                'count' : $('.moveM .count').val()
            },
            success: function(response) {
                if (response.status == 'ok') {
                    $('.grid-view tr[data-key=' + id + ']').parents('.grid-view').find(
                        'tr.filters input:eq(0)').trigger('change');
                } else if (response.status == 'error') {
                    console.log(response.msg);
                }
            }
        });
        $('.moveM').modal('hide');
    });
}
$(document).ready(function() {
    move();
});