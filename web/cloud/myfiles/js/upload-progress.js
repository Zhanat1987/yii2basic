$(document).ready(function () {
    $('#upload').submit(function(e) {
        $.ajax({
            url: '/php54/default/upload',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            }
        });
        return false;
    });
    var interval_id = 0;
    function stopProgress()
    {
        clearInterval(interval_id);
    }
    $(document).ajaxStart(function(){
        interval_id = setInterval(function() {
            $.ajax({
                type: 'GET',
                url: '/php54/default/progress',
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'ok') {
                        console.log(response.msg);
                    } else if (response.status == 'ok') {
                        console.log(response.msg);
                        stopProgress();
                    }
                    stopProgress();
                }
            });
        }, 300);
    });
    $(document).ajaxStop(function(){
        console.log('ajaxStop');
    });
});