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
    $('.region_idM tr.filters input, .region_area_idM tr.filters input, ' +
        '.city_idM tr.filters input, .street_idM tr.filters input').live('change', function() {
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
    $('.region_idM .btn-primary, .region_area_idM .btn-primary, ' +
        '.city_idM .btn-primary, .street_idM .btn-primary').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $('#' + $modal.attr('id')).select2('destroy').select2().select2('val', $checkbox.val());
        }
        $(this).next('.btn-danger').click();
        return false;
    });
    $('.region_idM input[type=checkbox], .region_area_idM input[type=checkbox], ' +
        '.city_idM input[type=checkbox], .street_idM input[type=checkbox]').live('change', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $modal.find('.btn-info').prop('disabled', false);
        } else {
            $modal.find('.btn-info').prop('disabled', true);
        }
        return false;
    });
    $('.region_idM .btn-info, .region_area_idM .btn-info, ' +
        '.city_idM .btn-info, .street_idM .btn-info').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        var v = $('#' + $modal.attr('id') + ' option[selected=selected]').attr('value');
        if ($checkbox.length) {
            $.ajax({
                type: 'GET',
                url: '/catalog/catalog/modal',
                dataType: 'html',
                data: {
                    'id' : $checkbox.val()
                },
                success: function(data) {
                    $('.modal[aria-hidden="false"] .modal-body').html(data);
                    $('.modal[aria-hidden="false"] input').val(
                        $('.modal[aria-hidden="false"] .grid-view').attr('phrase'));
                    $.ajax({
                        type: 'GET',
                        url: '/catalog/catalog/get-list',
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
                        data: {
                            'type' : $modal.attr('entity')
                        },
                        success: function(response) {
                            if (response.status = 'ok') {
                                $('#' + $modal.attr('id')).select2('destroy');
                                var options = '';
                                for (var i in response.data) {
                                    if (i == v) {
                                        options += '<option value="' + i + '" selected="selected">' +
                                            response.data[i] + '</option>';
                                    } else {
                                        options += '<option value="' + i + '">' +
                                            response.data[i] + '</option>';
                                    }
                                }
                                $('#' + $modal.attr('id')).html(options).select2().select2('val', v);
                            } else {
                                console.log(response.msg);
                            }
                        }
                    });
                }
            });
        }
        $(this).next('.btn-danger').click();
        return false;
    });
}
jQuery(document).ready(function () {
    gridModal();
});