
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
    })


})(jQuery)
