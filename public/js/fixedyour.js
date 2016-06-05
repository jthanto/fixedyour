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
            addListeners();
            startQuotes();
            initContact();
            //doMagic
        };

        var loadPage = function(e){
            $(this).blur();
            var $menuItem = getActiveMenuItem();
            if(!$(this).hasClass('active'))
            {
                loadPageData($(this).attr('data-page'));
                $menuItem.removeClass('active');
                $(this).addClass('active');
            }
            e.stopPropagation();
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
                // $('footer').css({position: 'absolute', left:0, bottom: 0});
                // console.log($('footer'))
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
            // $.ajax({
            //
            // });
        };

        var initContact = function(){
            $(document).on('click', '#btnContactSend', function(){
                var postData = {
                    action:'contact_mail',
                    name:$('#contactName').val(),
                    from:$('#contactFrom').val(),
                    other:$('#contactOther').val(),
                    content:$('#contactContent').find('textarea').val()
                };

                $.ajax('load.php', {
                    method: 'post',
                    dataType: 'json',
                    data: postData,
                    success: function(data){
                        if(data.status === 'success'){
                            $('#contactRecipient').find('input').css('border-bottom','#DEA241 2px solid');
                            $('#contactContent').find('textarea').css('border-color','#ffd18b');
                            alert('Takk for epost');
                        } else if (data.status === 'error'){
                            if(data.message.body && data.message.body.length){
                                $('#contactContent').find('textarea').css('border-color','#FF0000');
                            }
                            if(data.message.from && data.message.from.length){
                                $('#contactFrom').css('border-bottom','#FF0000 2px solid');
                            }

                            if(data.message.name && data.message.name.length){
                                $('#contactName').css('border-bottom','#FF0000 2px solid');
                            }
                            if(data.message.replyto && data.message.replyto.length) {
                                $('#contactFrom').css('border-bottom','#FF0000 2px solid');
                            }
                        }
                    },
                    error: function(){
                        alert('Buuuu, ukjent feil :(');
                    }});
                });
        };


        return {
            init: initialize
        }
    };

    fixedyour.Validation = function(){
        var emptyVal = function (val){
            return (val.length > 0)
        };
        return {isEmptyVal: emptyVal()};
    };
})($);


var PageHandler = new fixedyour.Page;
PageHandler.init();
