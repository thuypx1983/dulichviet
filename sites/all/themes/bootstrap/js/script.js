
(function ($) {

    $(document).ready(function () {
        $('.view-product-hot .views-row,.view-news-hot .views-row,.region-before-footer section, #block-views-product-list-1-block-2 .views-row').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });
         $('.region-header-top >section').matchHeight({
                    byRow: true,
                    property: 'height',
                    target: null,
                    remove: false
         });
        $('#webform-client-form-16 .form-actions').appendTo('#webform-client-form-16 .webform-component-email');
        $('.node-type-tour .page-header').prependTo('.node-type-tour .group-right');


        // init with element
        $('.view-news .view-content').masonry({
            // options...
            itemSelector: '.grid-item'
        });



        var web_url = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');


        $("body").on("click", ".share-fb", function (event) {
            var target = $(this).parent().parent().parent().find('.hidden-all a');

            var href = web_url+target.attr("href");


            FB.ui({
                method: 'share',
                display: 'popup',
                href: href,
            }, function (response) { });
        });

        $("body").on("click", ".share-google", function (event) {
            var target = $(this).parent().parent().parent().find('.hidden-all a');

            var href = 'https://plus.google.com/share?url='+web_url+target.attr("href");

            window.open(href, "Google Plus Share", 'width=800, height=600');
        });

        $("body").on("click", ".share-chain", function (event) {
            var target = $(this).parent().parent().parent().find('.hidden-all a');

            var href = web_url+target.attr("href");
            $.fancybox(
                {
                    content:'<h3>Đường dẫn đến tour</h3><p>'+href+'</p>',
                }
            );
        });

        $('.view-search-tour .views-field-field-departure-day').each(function(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            }

            if(mm<10) {
                mm='0'+mm
            }

            today = dd+'/'+mm+'/'+yyyy;
            if($(this).text().indexOf(today) > -1){
                $(this).addClass('current-date')
            }
        })
    })

    $(function() {
        $('nav#mobile-menu').mmenu({
            extensions				: [ 'effect-slide-menu', 'shadow-page', 'shadow-panels' ],
            keyboardNavigation 		: true,
            screenReader 			: true,
            counters				: true,
            navbar 	: {
                title	: 'Danh mục'
            },
            navbars	: [
                {
                    position	: 'top',
                    content		: [ 'searchfield' ]
                }, {
                    position	: 'top',
                    content		: [
                        'prev',
                        'title',
                        'close'
                    ]
                }, {
                    position	: 'bottom',
                    content		: [
                        '<a href="http://mmenu.frebsite.nl/wordpress-plugin.html" target="_blank">WordPress plugin</a>'
                    ]
                }
            ]
        });
    });
})(jQuery)
