/*
*
*/

var fixedyour = fixedyour || {};

(function($){

    fixedyour.Page = function() {

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
            $.get(section, {page: section}, function(data){
                if (typeof callback == 'function'){
                    callback(data);
                }
            });
        };

        var loadPage = function(){
            loadPageData($(this).attr('data-page'), function(data){

            //loadSection($(this).attr('data-page'), function(data){
            //    console.log(data);
            //    console.log(containerRight);
            //    containerRight.html(data)
            //});
        };

        var loadPageData = function(section, callback){
            $.get('PageLoader.php',{page:section}, function(data){
                console.log(data);
                containerLeft.html(data.left);
                containerRight.html(data.right);
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

    fixedyour.Validation = function(){
        return {};
    };
})($);


var PageHandler = new fixedyour.Page;
PageHandler.init();
