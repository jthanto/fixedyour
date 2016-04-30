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

        var loadingPage = false;

        var menuItems = $('nav#main_menu a');
        var containerLeft = $('main section#container_left');
        var containerRight = $('main section#container_right');
        var containerCenter = $('main section#container_center');
        var allContainers = $('main section');

        /* Functions */
        var loader = function() {
            alert('heyoo');
        };

        var initialize = function() {
            buildSite();
            startQuotes();
            //doMagic
        };

        var buildSite = function(){
            loadPageData('home');
            addListeners();
        };

        var loadPage = function(){
            $(this).blur();
            var $menuItem = getActiveMenuItem();
            if(!$(this).hasClass('active'))
            {
                loadPageData($(this).attr('data-page'));
                $menuItem.removeClass('active');
                $(this).addClass('active');
            }
        };

        var getActiveMenuItem = function() {
            return $('nav#main_menu a.active');
        };

        var loadPageData = function(section, callback){
            if(!loadingPage){
                loadingPage = true;
                $.get('load.php',{page:section}, function(data){
                    var sections = $.parseJSON(data);
                    if(typeof sections == 'object'){
                        applyPageData(sections);
                    }
                    loadingPage = false;
                });
            }
        };

        var applyPageData = function (sections){
            allContainers.fadeOut(200).promise().done(function() {
                switch (sections.length) {
                    case 1:
                        containerCenter.html(sections[0]);
                        sectionSwitcher(containerCenter);
                        break;
                    case 2:
                    default:
                        containerLeft.html(sections[0]);
                        containerRight.html(sections[1]);
                        sectionSwitcher(allContainers.not('#container_center'));
                        break;
                }
            });
        };

        var sectionSwitcher = function($displayContent) {
                $displayContent.fadeIn(200);
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
