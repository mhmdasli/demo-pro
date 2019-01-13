/*
 * Application
 */

$(document).ready(function(){
    // update active tab on nav bar
    $('.nav-item').on('click',function () {
        $('.nav-item').removeClass('active');
        $(this).addClass('active')
    })
});