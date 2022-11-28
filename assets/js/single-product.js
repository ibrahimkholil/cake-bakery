jQuery(function($){
    "use strict";
    var on_touch = !$('body').hasClass('ts_desktop');

    /*** Product Video ***/
    // $('a.ts-product-video-button').on('click', function(e){
    //     e.preventDefault();
    //     var product_id = $(this).data('product_id');
    //     var container = $('#ts-product-video-modal');
    //     if( container.find('.product-video-content').html() ){
    //         container.addClass('show');
    //     }
    //     else{
    //         container.addClass('loading');
    //         $.ajax({
    //             type : 'POST'
    //             ,url : mydecor_params.ajax_url
    //             ,data : {action : 'mydecor_load_product_video', product_id: product_id}
    //             ,success : function(response){
    //                 container.find('.product-video-content').html( response );
    //                 container.removeClass('loading').addClass('show');
    //             }
    //         });
    //     }
    // });



    /*** Size Chart ***/
    $('.ts-product-size-chart-button').on('click', function(e){
        e.preventDefault();
        $('#ts-product-size-chart-modal').addClass('show');
    });

    /*** Show more/less product content ***/
    if( $('.single-product .more-less-buttons').length > 0 ){
        var product_content = $('.single-product .more-less-buttons').siblings('.product-content');
        if( product_content.height() < 320 ){
            $('.single-product .more-less-buttons').remove();
            product_content.removeClass('closed show-more-less');
        }
        else{
            var timeout = 200 + ( product_content.find('img').length * 200 );
            setTimeout(function(){
                var scrollheight = product_content.get(0).scrollHeight;
                var speed = scrollheight / 1500;
                var style = '<style>'
                    + '.product-content.show-more-less{transition:'+speed+'s ease;}'
                    + '.product-content.opened{max-height:'+scrollheight+'px;}'
                    + '</style>';
                $('head').append( style );
            }, timeout);
        }
    }

    $('.single-product .more-less-buttons a').on('click', function(e){
        e.preventDefault();
        $(this).hide();
        $(this).siblings('a').show();
        var action = $(this).data('action');
        $(this).parent().siblings('.product-content').removeClass('opened closed').addClass(action);

        if( action == 'closed' ){
            var top = $(this).parents('.woocommerce-tabs').offset().top - get_fixed_header_height() - 10;
            $('body, html').animate({
                scrollTop: top
            }, 1000);
        }
    });

    function get_fixed_header_height(){
        var admin_bar_height = $('#wpadminbar').length > 0?$('#wpadminbar').outerHeight():0;
        var sticky_height = $('.is-sticky .header-sticky').length > 0?$('.is-sticky .header-sticky').outerHeight():0;
        return admin_bar_height + sticky_height;
    }

    /*** Next/Prev ***/
    if( $('.single-navigation').length ){
        var image_wrapper = $('.woocommerce-product-gallery');
        var image_top = image_wrapper.offset().top;
        $(window).on('scroll', function(){
            if( $(this).scrollTop() > image_top && $(this).scrollTop() < image_top + image_wrapper.height() ){
                $('.single-navigation').addClass('visible');
            }
            else{
                $('.single-navigation').removeClass('visible');
            }
        });
    }

    /*** Buy Now ***/
    $('.ts-buy-now-button').on('click', function(e){
        e.preventDefault();
        var cart_form = $(this).parents('.summary').find('form.cart');
        if( cart_form.length ){
            if( !$(this).hasClass('disabled') ){
                $(document).off('submit', '.product:not(.product-type-external) .summary form.cart'); /* disable ajax add to cart */
                cart_form.append('<input type="hidden" name="ts_buy_now" value="1" />');
            }
            cart_form.find('.single_add_to_cart_button').trigger('click');
        }
    });

    $(document).on('found_variation', 'form.variations_form', function(){
        $(this).parents('.summary').find('.ts-buy-now-button').removeClass('disabled');
    });

    $(document).on('reset_image', 'form.variations_form', function(){
        $(this).parents('.summary').find('.ts-buy-now-button').addClass('disabled');
    });
});