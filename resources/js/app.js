require('./bootstrap');
import 'places.js';

$(document).ready(function () {
    
    $("#app").toggleClass('scrolled');

    $(window).scroll(function(){
        $("#app").toggleClass('scrolled', $(this).scrollTop() > 150)
        console.log("ok");
    })
});

