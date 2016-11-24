
(function ($) {
    $(document).ready(function () {
        $('.view-product-hot .views-row,.view-news-hot .views-row').matchHeight({
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

    })


})(jQuery)
