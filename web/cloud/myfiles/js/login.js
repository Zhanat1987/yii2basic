/**
 * Created by admin on 09.04.14.
 */

function swapScreen(id) {
    jQuery('.visible').removeClass('visible animated fadeInUp');
    jQuery('#' + id).addClass('visible animated fadeInUp');
}
jQuery(document).ready(function () {
    /**
     * мои скрипты начало
     */
    $('#loginform-username, #signupform-username').before('<i class="fa fa-user"></i>');
    $('#loginform-password, #signupform-password, #resetpasswordform-password').before('<i class="fa fa-lock"></i>');
    $('#passwordresetrequestform-email, #signupform-email').before('<i class="fa fa-envelope"></i>');
    $('div.checkbox label').addClass('checkbox');
    $('div.checkbox').removeAttr('class');
    if ($('#forgot').has('div.alert').length || $('#forgot').has('div.has-error').length) {
        swapScreen('forgot');
    }
    if ($('#register').has('div.has-error').length) {
        swapScreen('register');
    }
    /**
     * мои скрипты конец
     */
    App.setPage("login");  //Set current page
    App.init(); //Initialise plugins and elements
});