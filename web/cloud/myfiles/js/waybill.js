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
        tbDatePicker();
    });
    $('.rbpTrReplace').live('click', function() {
        $(this).parent().parent().html($('.rbpTr').html());
        $('#table-tab-pk .rbRemove:eq(1)').removeClass('rbRemove').addClass('rbpTrReplace');
        $('#table-tab-pk tr:eq(2) select').select2();
        tbDatePicker();
    });
}
function rbkAdd()
{
    $('#table-tab-kk tr:last input, #table-tab-kk tr:last select').live('change', function() {
        $('#table-tab-kk').append('<tr>' + $('.rbkTr').html() + '</tr>');
        $('#table-tab-kk tr:last select').select2();
        tbDatePicker();
    });
}
function rbpAdd()
{
    $('#table-tab-pk tr:last input, #table-tab-pk tr:last select').live('change', function() {
        $('#table-tab-pk').append('<tr>' + $('.rbpTr').html() + '</tr>');
        $('#table-tab-pk tr:last select').select2();
        tbDatePicker();
    });
}
function rbDelete()
{
    $('.rbDelete').live('click', function() {
        var id = parseInt($(this).attr('id'));
        if (id) {
            $.ajax({
                type: 'GET',
                url: '/waybill/waybill/delete-body',
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
var barCodeSingleInTime = 1;
// считывание штрих кода
function barCode()
{
	$('.kkRn').live('keypress', function(e) {
		if (e.keyCode == 13 || e.which == 13) {
			var $this = $(this);
			var v = $this.val();
			if (v.length == 16 && v.substr(0, 1) == '0') {
				var l16 = true;
				v = v.substr(1);
			} else {
				var l16 = false;
			}
			if (l16 == true || v.length == 15) {
				/**
				 * 15 - 6,7
				 * 16 - 7,8
				 * v - уже всегда = 15 символов
				 */
				var id_infodonor = v.substr(5, 2);
				var first = v.substr(0, 2);
				if (first == '12' || first == '14') {
					var blood_group = v.substr(2, 1);
					if (blood_group == '1' || blood_group == '2' || blood_group == '3'
						|| blood_group == '4' || blood_group == '5' || blood_group == '6'
						|| blood_group == '7' || blood_group == '8') {
						var component_id = v.substr(3, 2);
						var $tr = $this.parent().parent();
						switch (blood_group) {
							case '1':
								$tr.find(".blood_group").val("1").trigger("change");
								$tr.find(".rh_factor").val("1").trigger("change");
								break;
							case '2':
								$tr.find(".blood_group").val("2").trigger("change");
								$tr.find(".rh_factor").val("1").trigger("change");
								break;
							case '3':
								$tr.find(".blood_group").val("3").trigger("change");
								$tr.find(".rh_factor").val("1").trigger("change");
								break;
							case '4':
								$tr.find(".blood_group").val("4").trigger("change");
								$tr.find(".rh_factor").val("1").trigger("change");
								break;
							case '5':
								$tr.find(".blood_group").val("1").trigger("change");
								$tr.find(".rh_factor").val("2").trigger("change");
								break;
							case '6':
								$tr.find(".blood_group").val("2").trigger("change");
								$tr.find(".rh_factor").val("2").trigger("change");
								break;
							case '7':
								$tr.find(".blood_group").val("3").trigger("change");
								$tr.find(".rh_factor").val("2").trigger("change");
								break;
							case '8':
								$tr.find(".blood_group").val("4").trigger("change");
								$tr.find(".rh_factor").val("2").trigger("change");
								break;
						}
						$.ajax({
								url: "/waybill/waybill/rest-get",
								type: "GET",
								contentType: "application/json; charset=utf-8",
								data: ({
									id_infodonor : component_id,
									id_infodonor2 : id_infodonor,
									rn : v
								}),
								dataType: "json",
								success: function(response){
									if (response.status == 'infoblood') {
										if (response.id_spr_comps_drugs) {
											$tr.find(".component_id").val(response.id_spr_comps_drugs).trigger("change");
										}
										$this.blur();
									} else if (response.status == 'infodonor') {
										if (response.id_spr_comps_drugs) {
											$tr.find(".component_id").val(response.id_spr_comps_drugs).trigger("change");
										}
										if (response.phenotype) {
											$tr.find(".phenotype").val(response.phenotype).trigger("change");
										}
										if (response.volume) {
											$tr.find(".volume").val(response.volume).trigger("change");
										}
										if (response.date_prepare) {
											$tr.find(".date_prepare").val(response.date_prepare).trigger("change");
										}
										if (response.date_expiration) {
											$tr.find(".date_expiration").val(response.date_expiration).trigger("change");
										}
										if (response.donor) {
											$tr.find(".donor").val(response.donor).trigger("change");
										}
										$this.blur();
									}
								},
								beforeSend: function() {
									if (barCodeSingleInTime == 1) {
										barCodeSingleInTime = 0;
									} else {
										return false;
									}
								},
								complete: function() {
									barCodeSingleInTime = 1;
								}
							}
						);
						$this.val(v);
					}
				}
			}
			e.preventDefault();
		}
	});
}
jQuery(document).ready(function () {
    request();
    rbRemove();
    rbkAdd();
    rbpAdd();
    rbDelete();
	barCode();
});