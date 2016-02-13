/*
*
*/

var fixedyour = fixedyour || {};

(function($){

    fixedyour.page = function() {

        /* Setup variables */
        var toasterSetup = {
            "closeButton": false,
            "debug": false,
            "positionClass": "toast-top-full-width",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        var menuItems = $('nav#main_menu a');
        var containerLeft = $('main section#container_left');
        var containerRight = $('main section#container_right');

        /* Functions */
        var loader = function() {
            alert('heyoo');
        };

        var initialize = function() {
            buildSite();
            startQuotes();
            //addBigSlide
            //addMenuSlide();
            //doMagic
        };

        var buildSite = function(){
            loadSection('home', function(data, err){
                fadeContent(data, containerLeft, err)
            });
            loadSection('contact', function(data, err){
                containerRight.html(data);
            });
            addListeners();
        };

        var fadeContent = function(data, container, err){
            container.hide();
            container.html(data);
            container.fadeIn(5);
        };

        var loadSection = function(section, callback){
            section = 'templates/'+section+'.mustache';
            $.get(section, {}, function(data){
                if (typeof callback == 'function'){
                    callback(data);
                }
            });
        };

        var loadPage = function(){
            loadSection($(this).attr('data-page'), function(data, err){
                console.log(data);
                console.log(containerRight);
                containerRight.html(data)
            });
        };

        var addListeners = function(){
            menuItems.click(loadPage);
        };

        var startQuotes = function(){
            var setup = {url: 'quotes'};
            $.ajax({

            });
        };

        return {
            init: initialize
        }
    };

    fixedyour.validation = function(){

    };
})($);


var pagehandler = new fixedyour.page;
pagehandler.init();

//$(document).ready(function() {
//
//

//
//    /* Prevent default if menu links are "#". */
//    $('#menu ul li a').each( function() {
//        var nav = $(this);
//        if( nav.length > 0 ) {
//            if( nav.attr('href') == '#' ) {
//                //console.log(nav);
//                $(this).click(
//                    function(e) {
//                        e.preventDefault();
//                    }
//                );
//            }
//        }
//    });
//
//});
//

//
//    }
//});