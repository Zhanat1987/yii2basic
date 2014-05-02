jQuery.fn.live = function (types, data, fn) {
    jQuery(this.context).on(types,this.selector,data,fn);
    return this;
};
jQuery(document).ready(function () {
    App.setPage("widgets_box");  //Set current page
    App.init(); //Initialise plugins and elements

//    console.log(window.location.pathname);
//    console.log(window.location.host);
//    console.log(window.location.href);
//    console.log(window.location.port);
//    console.log(window.location.protocol);
//    console.log(window.location.hash);
    /**
     * текущий пункт меню
     */
    $('#sidebar ul li a[href="' + window.location.pathname +
        '"]').parent('li').addClass('active').parents('li.has-sub').addClass('active');
});