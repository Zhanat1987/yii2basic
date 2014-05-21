function gridModal()
{
    $('#region_id, #region_area_id, #city_id, #street_id').live('click', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '/catalog/catalog/modal',
            dataType: 'html',
            data: {
                'type' : id
            },
            success: function(data) {
                $('.' + id + 'M .modal-body').html(data);
                $('.' + id + 'M').modal();
            }
        });
        return false;
    });
    $('.region_idM input, .region_area_idM input, .city_idM input, .street_idM input').live('change', function() {
        $.ajax({
            type: 'GET',
            url: '/catalog/catalog/modal',
            dataType: 'html',
            data: {
                'name' : $(this).val()
            },
            success: function(data) {
                $('.modal[aria-hidden="false"] .modal-body').html(data);
                $('.modal[aria-hidden="false"] input').val($('.modal[aria-hidden="false"] .grid-view').attr('phrase'));
            }
        });
        return false;
    });
}
jQuery(document).ready(function () {
    gridModal();
});