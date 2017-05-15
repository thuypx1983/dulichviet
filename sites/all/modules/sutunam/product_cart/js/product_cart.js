(function($){

    $(function(){
        $('.field-name-field-prices .btn-product-cart').click(function(event){
            event.preventDefault();
            var tour=$(this).attr('tour');
            var date=$(this).attr('date');
            $(document).find('#edit-submitted-product').val('Tour: '+tour+ ' - ngày khởi hành: '+ date);
            $.fancybox($('#block-webform-client-block-470'));

        })
       $('.btn-product-cart-list').click(function(event){
           event.preventDefault();
            /*var tour=$(this).attr('tour');
            var date=$(this).attr('date');
            $(document).find('#edit-submitted-product').val('Tour: '+tour+ ' - ngày khởi hành: '+ date);*/
            $.fancybox($('#block-webform-client-block-470'));

        })


    })
})(jQuery)