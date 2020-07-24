require('./bootstrap');
import 'places.js';


$(document).ready(function () {
    
    //SCROLL NAVBAR
    $("#app").toggleClass('scrolled');

    $(window).scroll(function(){
        $("#app").toggleClass('scrolled', $(this).scrollTop() > 150)
    })

        // C A R O U S E L //
    var first = $ (".first");
    var last = $(".last");
    var left = $ (".fa-caret-left");
    var right = $ (".fa-caret-right");

    right.click(function(){
        var current = $(".discover");
        current.removeClass("discover");
        current.addClass("discover-none");

        current.next().removeClass("discover-none");
        current.next().addClass("discover");

        if(current.hasClass("last")){
            first.removeClass("discover-none");
            first.addClass("discover");
        }
    });

    left.click(function(){
        var current = $(".discover");
        current.removeClass("discover");
        current.addClass("discover-none");

        current.prev().removeClass("discover-none");
        current.prev().addClass("discover");

        if(current.hasClass("first")){
            last.removeClass("discover-none");
            last.addClass("discover");
        }
    });
});

