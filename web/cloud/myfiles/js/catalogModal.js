function afterAjax(data)
{
    $('.modal[aria-hidden="false"] .modal-body').html(data);
    $('.modal[aria-hidden="false"] tr.filters input').val(
        $('.modal[aria-hidden="false"] .grid-view').attr('phrase'));
    if ($('a[rel$=editable]').length) {
        $('a[rel$=editable]').addClass('editable').addClass('editable-click').editable();
        $('.editable-empty').html('не задано');
    }
}
function gridModal()
{
    $('.sbSpan').live('click', function() {
        var id = $(this).attr('id');
        var editable = $(this).attr('editable');
        $.ajax({
            type: 'GET',
            url: '/catalog/catalog/modal',
            dataType: 'html',
            data: {
                'type' : id,
                'editable' : editable
            },
            success: function(data) {
                $('.' + id + 'M .modal-body').html(data);
                $('.' + id + 'M').modal();
                if ($('a[rel=name_editable]').length) {
                    $('a[rel=name_editable]').addClass('editable').addClass('editable-click').editable();
                    $('.editable-empty').html('не задано');
                }
            }
        });
        return false;
    });
    $('.sbSpanM tr.filters input').live('change', function() {
        $.ajax({
            type: 'GET',
            url: '/catalog/catalog/modal',
            dataType: 'html',
            data: {
                'nameM' : $(this).val()
            },
            success: function(data) {
                $('.modal[aria-hidden="false"] .modal-body').html(data);
                $('.modal[aria-hidden="false"] tr.filters input').val(
                    $('.modal[aria-hidden="false"] .grid-view').attr('phrase'));
                if ($('a[rel=name_editable]').length) {
                    $('a[rel=name_editable]').addClass('editable').addClass('editable-click').editable();
                    $('.editable-empty').html('не задано');
                }
            }
        });
        return false;
    });
    $('.selectBtnPrimary').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $('#' + $modal.attr('id')).select2('destroy').select2().select2('val', $checkbox.val());
        }
        $(this).next('.btn-danger').click();
        return false;
    });
    $('.sbSpanM input[type=checkbox]').live('change', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $modal.find('.btn-info').prop('disabled', false);
        } else {
            $modal.find('.btn-info').prop('disabled', true);
        }
        return false;
    });
    $('.selectBtnInfo').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        var v = $('#' + $modal.attr('id') + ' option[selected=selected]').attr('value');
        if ($checkbox.length) {
            $.ajax({
                type: 'GET',
                url: '/catalog/catalog/modal',
                dataType: 'html',
                data: {
                    'id' : $checkbox.val() ? $checkbox.val() : $('.checkboxSingleTr').attr('data-key')
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
    $('.sbSpanM .btn-success').live('click', function() {
        $('.catalogM h4.modal-title').text($('.modal[aria-hidden="false"]').attr('create'));
        $('.catalogM').modal().css({'z-index': parseInt($('.catalogM').css('z-index')) + 1});
        return false;
    });
    $('.catalogM .close, .catalogM .btn-danger').live('click', function() {
        $('.catalogM').modal('hide');
        return false;
    });
    $('.catalogM .btn-primary').live('click', function() {
        var name = trim($('#catalog-name').val());
        var type = parseInt($('#catalog-type').val());
        if (name && type) {
            $('.catalogM .field-catalog-name').removeClass('has-error');
            $.ajax({
                type: 'GET',
                url: '/catalog/catalog/modal-create',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: {
                    'name' : name,
                    'type' : type
                },
                success: function(response) {
                    if (response.status = 'ok') {
                        $('.catalogM').modal('hide');
                        var $modal = $('.modal[aria-hidden="false"]');
                        var v = $('#' + $modal.attr('id') + ' option[selected=selected]').attr('value');
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
                        $.ajax({
                            type: 'GET',
                            url: '/catalog/catalog/modal',
                            dataType: 'html',
                            data: {
                                'nameM' : ''
                            },
                            success: function(data) {
                                $('.modal[aria-hidden="false"] .modal-body').html(data);
                            }
                        });
                    } else {
                        console.log(response.msg);
                    }
                }
            });
        } else {
            $('.catalogM .field-catalog-name').addClass('has-error');
        }
        return false;
    });
}

jQuery(document).ready(function () {
    gridModal();
});