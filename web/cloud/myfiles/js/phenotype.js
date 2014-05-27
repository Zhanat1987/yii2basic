function stripos(f_haystack, f_needle, f_offset)
{
    var haystack = (f_haystack + '')
        .toLowerCase();
    var needle = (f_needle + '')
        .toLowerCase();
    var index = 0;

    if ((index = haystack.indexOf(needle, f_offset)) !== -1) {
        return index;
    }
    return false;
}
function phenotype()
{
    $('.phenotype-btn').live('click', function() {
        $('.phenotypeM').modal().attr('index',
                $('.phenotype-btn').index(this)).css('z-index',
                parseInt($('.phenotypeM').css('z-index')) + 2);
        $('.checkbox_img').each(function() {
            if ($(this).hasClass('checkbox_1')) {
                $(this).removeClass('checkbox_1').addClass('checkbox_2');
            }
        });
        var v = $(this).parent().prev().val();
        if (v) {
            var cp = stripos(v, 'c');
            var dp = stripos(v, 'd');
            var ep = stripos(v, 'e');
            var cv = '';
            var dv = '';
            var ev = '';
            if (cp !== false) {
                if (dp !== false) {
                    cv = v.substring(0, dp);
                } else if (ep !== false) {
                    cv = v.substring(0, ep);
                } else {
                    cv = v;
                }
                $('.checkbox_img[v=' + cv +
                    ']').removeClass('checkbox_2').addClass('checkbox_1');
            }
            if (dp !== false) {
                if (ep !== false) {
                    dv = v.substring(dp, ep);
                } else if (ep === false) {
                    dv = v.substring(dp);
                }
                $('.checkbox_img[v=' + dv +
                    ']').removeClass('checkbox_2').addClass('checkbox_1');
            }
            if (ep !== false) {
                ev = v.substring(ep);
                $('.checkbox_img[v=' + ev +
                    ']').removeClass('checkbox_2').addClass('checkbox_1');
            }
        }
        return false;
    });
    $('.phenotypeM .btn-primary').bind('click', function() {
        var c = $('.c.checkbox_1').length ? $('.c.checkbox_1').text() : '';
        var d = $('.d.checkbox_1').length ? $('.d.checkbox_1').text() : '';
        var e = $('.e.checkbox_1').length ? $('.e.checkbox_1').text() : '';
        $('input.phenotype:eq(' + $('.phenotypeM').attr('index') +
            ')').val(c + d + e).trigger('change');
        $('.phenotypeM .btn-danger').click();
        return false;
    });
    $('.checkbox_img').bind('click', function() {
        if ($(this).hasClass('checkbox_1')) {
            $(this).removeClass('checkbox_1').addClass('checkbox_2');
        } else if ($(this).hasClass('checkbox_2')) {
            $(this).removeClass('checkbox_2').addClass('checkbox_1');
        }
        if ($(this).hasClass('c')) {
            $('.c.checkbox_img').not(this).removeClass('checkbox_1').addClass('checkbox_2');
        } else if ($(this).hasClass('d')) {
            $('.d.checkbox_img').not(this).removeClass('checkbox_1').addClass('checkbox_2');
        } else if ($(this).hasClass('e')) {
            $('.e.checkbox_img').not(this).removeClass('checkbox_1').addClass('checkbox_2');
        }
    });
    $('.phenotypeM tr td:eq(0)').css({'width':'150px'});
    $('.phenotypeM tr td:eq(1)').css({'width':'210px'});
}
$(document).ready(function() {
    phenotype();
});