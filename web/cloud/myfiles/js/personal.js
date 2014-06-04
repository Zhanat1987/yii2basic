function editableAfterAjax()
{
    if ($('a[rel$=editable]').length) {
        $('a[rel$=editable]').addClass('editable').addClass('editable-click').editable();
        $('.editable-empty').html('не задано');
    }
    $('.department2').select2();
}
function filterAfterAjax(data)
{
    $('.modal[aria-hidden="false"] .modal-body').html(data);
    $('.modal[aria-hidden="false"] tr.filters input:eq(0)').val($('.filterAfterAjax').attr('surname'));
    $('.modal[aria-hidden="false"] tr.filters input:eq(1)').val($('.filterAfterAjax').attr('name'));
    $('.modal[aria-hidden="false"] tr.filters input:eq(2)').val($('.filterAfterAjax').attr('patronimic'));
    $('.modal[aria-hidden="false"] tr.filters input:eq(3)').val($('.filterAfterAjax').attr('post'));
    $('.modal[aria-hidden="false"] tr.filters select').val($('.filterAfterAjax').attr('department'));
}
function personal()
{
    $('.personalSpan').live('click', function() {
        $.ajax({
            type: 'GET',
            url: '/catalog/personal/modal',
            dataType: 'html',
            success: function(data) {
                $('.personalSpanM .modal-body').html(data);
                $('.personalSpanM').modal();
                editableAfterAjax();
            }
        });
        return false;
    });
    $('.personalPrimary').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $('#' + $modal.attr('id')).select2('destroy').select2().select2('val', $checkbox.val());
        }
        $(this).next('.btn-danger').click();
        return false;
    });
    $('.personalSpanM input[type=checkbox]').live('change', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        if ($checkbox.length) {
            $modal.find('.btn-info').prop('disabled', false);
        } else {
            $modal.find('.btn-info').prop('disabled', true);
        }
        return false;
    });
    $('.personalSpanM .btn-success').live('click', function() {
        if ($('.width2').length) {
            $('.personalM .modal-dialog').css({'width': $('.width2').text()});
        }
        $('.personalM').modal().css({'z-index': parseInt($('.personalM').css('z-index')) + 1});
        return false;
    });
    $('.personalM .close, .personalM .btn-danger').live('click', function() {
        $('.personalM').modal('hide');
        return false;
    });
    $('.personalSpanM tr.filters input,.personalSpanM tr.filters select').live('change', function() {
        $.ajax({
            type: 'GET',
            url: '/catalog/personal/modal',
            dataType: 'html',
            data: {
                'filter' : 1,
                'surname' : $('.personalSpanM tr.filters input:eq(0)').val(),
                'name' : $('.personalSpanM tr.filters input:eq(1)').val(),
                'patronimic' : $('.personalSpanM tr.filters input:eq(2)').val(),
                'post' : $('.personalSpanM tr.filters input:eq(3)').val(),
                'department' : $('.personalSpanM tr.filters select').val()
            },
            success: function(data) {
                filterAfterAjax(data);
                editableAfterAjax();
            }
        });
        return false;
    });
    $('.personalBtnInfo').live('click', function() {
        var $modal = $('.modal[aria-hidden="false"]');
        var $checkbox = $modal.find('input[type=checkbox]:checked');
        var v = $('#' + $modal.attr('id') + ' option[selected=selected]').attr('value');
        if ($checkbox.length) {
            $.ajax({
                type: 'GET',
                url: '/catalog/personal/modal',
                dataType: 'html',
                data: {
                    'id' : $checkbox.val() ? $checkbox.val() : $('.checkboxSingleTr').attr('data-key')
                },
                success: function(data) {
                    filterAfterAjax(data);
                    editableAfterAjax();
                    $.ajax({
                        type: 'GET',
                        url: '/catalog/personal/get-list',
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
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
    $('.personalM .btn-primary').live('click', function() {
        var surname = trim($('#personal-surname').val());
        var name = trim($('#personal-name').val());
        var patronimic = trim($('#personal-patronimic').val());
        var post = trim($('#personal-post').val());
        var department = trim($('#personal-department').val());
        if (surname && name) {
            $('.personalM .field-personal-surname, .personalM .field-personal-name').removeClass('has-error');
            $.ajax({
                type: 'GET',
                url: '/catalog/personal/modal-create',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: {
                    'surname' : surname,
                    'name' : name,
                    'patronimic' : patronimic,
                    'post' : post,
                    'department' : department
                },
                success: function(response) {
                    if (response.status = 'ok') {
                        $('.personalM').modal('hide');
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
                            url: '/catalog/personal/modal',
                            dataType: 'html',
                            success: function(data) {
                                filterAfterAjax(data);
                                editableAfterAjax();
                            }
                        });
                    } else {
                        console.log(response.msg);
                    }
                }
            });
        } else {
            if (!surname) {
                $('.personalM .field-personal-surname').addClass('has-error');
            } else {
                $('.personalM .field-personal-surname').removeClass('has-error');
            }
            if (!name) {
                $('.personalM .field-personal-name').addClass('has-error');
            } else {
                $('.personalM .field-personal-name').removeClass('has-error');
            }
        }
        return false;
    });
    $('.personalSpanM').on('hide.bs.modal', function (e) {
        window.history.pushState('string', 'Title', $('.requestUrl').text());
    });
}
jQuery(document).ready(function () {
    personal();
});