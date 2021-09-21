<script src="js/slick.min.js"></script>
<script>
    $('.testimonial-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true
    });
    $('.featured-products').slick({
        infinite: true,
        arrows: false,
        dots: false,
        autoplay: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: true,

        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]

    });
</script>
