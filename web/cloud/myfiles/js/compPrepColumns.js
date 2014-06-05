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
}
$(document).ready(function() {
    columns();
});