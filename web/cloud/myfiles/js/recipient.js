function addEpicrisis()
{
    $('.addEpicrisis').live('click', function() {
        $.ajax({
            url: "/recipient/info/current-data",
            type: "GET",
            contentType: "application/json; charset=utf-8",
            data: ({
                data : $('#recipient-form').serialize()
            }),
            dataType: "json",
            success: function(response){
                if (response.status == 'ok') {
                    window.location.href = '/recipient/epicrisis/create';
                } else {
                    console.log(response.msg);
                }
            }
        });
    });
}
jQuery(document).ready(function () {
    addEpicrisis();
});