$(document).ready(function () {
    $('#upload').submit(function() {
        $.ajax({
            async: true,
            url: '/php54/default/upload-apc',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false
        });
        return false;
    });
    $(document).ajaxStart(function(){
        var progresspump = setInterval(function(){
            $.ajax({
                type: 'GET',
                url: '/php54/default/progress-apc',
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                async: true,
                data: {
                    progress_key:$('#progress_key').val()
                },
                success: function(response) {
                    if (response.status == 'ok') {
                        console.log(response.msg);
                        $('#progress').css({'width':
                            response.percent + '%'}).html(response.percent + ' %');
                        if(response.percent > 99.999) {
                            clearInterval(progresspump);
                            $("#progressouter").removeClass("active");
                            $("#progress").html("Done");
                        }
                    } else if (response.status == 'error') {
                        console.log(response.msg);
                    }
                }
            });
        }, 500);
    });
});