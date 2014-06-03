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
}
$(document).ready(function() {
    move();
});