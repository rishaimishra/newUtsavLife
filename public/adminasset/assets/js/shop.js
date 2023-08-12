(function ($) {
    'use strict';
    /*Product Details*/
    var productDetails = function () {
        
        $('.product-slider-img').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.bottom-slider-img',
        });

        $('.bottom-slider-img').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.product-slider-img',
            dots: false,
            focusOnSelect: true,
            
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></button>'
        });

        // Remove active class from all thumbnail slides
        $('.bottom-slider-img .slick-slide').removeClass('slick-active');

        // Set active class to first thumbnail slides
        $('.bottom-slider-img .slick-slide').eq(0).addClass('slick-active');

        // On before slide change match active thumbnail to current slide
        $('.product-slider-img').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var mySlideNumber = nextSlide;
            $('.bottom-slider-img .slick-slide').removeClass('slick-active');
            $('.bottom-slider-img .slick-slide').eq(mySlideNumber).addClass('slick-active');
        });

        $('.product-slider-img').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var img = $(slick.$slides[nextSlide]).find("img");
            $('.zoomWindowContainer,.zoomContainer').remove();
            $(img).elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        });
        //Elevate Zoom
        if ( $(".product-slider-img").length ) {
            $('.product-slider-img .slick-active img').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        }
        //Filter color/Size
        $('.list-filter').each(function () {
            $(this).find('a').on('click', function (event) {
                event.preventDefault();
                $(this).parent().siblings().removeClass('active');
                $(this).parent().toggleClass('active');
                $(this).parents('.attr-detail').find('.current-size').text($(this).text());
                $(this).parents('.attr-detail').find('.current-color').text($(this).attr('data-color'));
            });
        });
        //Qty Up-Down
        $('.detail-qty').each(function () {
            var qtyval = parseInt($(this).find('.qty-val').text(), 10);
            $('.qty-up').on('click', function (event) {
                event.preventDefault();
                qtyval = qtyval + 1;
                $(this).prev().text(qtyval);
            });
            $('.qty-down').on('click', function (event) {
                event.preventDefault();
                qtyval = qtyval - 1;
                if (qtyval > 1) {
                    $(this).next().text(qtyval);
                } else {
                    qtyval = 1;
                    $(this).next().text(qtyval);
                }
            });
        });

        $('.dropdown-menu .cart_list').on('click', function (event) {
            event.stopPropagation();
        });
           /*---------------------
            Price range
        --------------------- */
        var sliderrange = $("#slider-range");
        var amountprice = $("#amount");
        $(function () {
            sliderrange.slider({
                range: true,
                min: 16,
                max: 400,
                values: [0, 300],
                slide: function (event, ui) {
                    amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            amountprice.val("$" + sliderrange.slider("values", 0) + " - $" + sliderrange.slider("values", 1));
        });
            // Slider Range JS
            if ($("#slider-range").length) {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 500,
                    values: [130, 250],
                    slide: function (event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
            }

    };

    //Load functions
    $(document).ready(function () {
        productDetails();
        
    });

})(jQuery);