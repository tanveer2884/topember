$(document).ready(function () {
    $('.card').hover(function () {
        $(this).find('.inactive-overlay').css('opacity', 0);
        $(this).find('.active-overlay').css('opacity', 1);
    }, function () {
        $(this).find('.inactive-overlay').animate({ opacity: 1 }, 300);
        $(this).find('.active-overlay').animate({ opacity: 0 }, 300);
    });

    if ($(':has(.card-slider)').length > 0) {
        $(".card-slider").slick({
            dots: false,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            prevArrow:
                '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
            nextArrow:
                '<button class="slick-next" aria-label="Next" type="button">Next</button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }

    if ($(':has(.history-slick)').length > 0) {
        $('.history-slick').slick({
            dots: false,
            arrows: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            ]
        });
    }

    if ($(':has(.award-slick)').length > 0) {
        $('.award-slick').slick({
            dots: false,
            arrows: false,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            ]
        });
    }

    checkScrolldownIdExist = $('#scrolldown');
    if (checkScrolldownIdExist.length > 0) {
        document
            .getElementById("scrolldown")
            .addEventListener("click", function (event) {
                event.preventDefault();

                const scrollAmount = 1200;

                const currentScrollPosition = window.scrollY;
                const newScrollPosition = currentScrollPosition + scrollAmount;

                window.scrollTo({
                    top: newScrollPosition,
                    behavior: "smooth",
                });
            });
    }
});

// Scroll down
document.addEventListener("DOMContentLoaded", function () {
    checkIdExist = $('#myCircularText');

    if (checkIdExist.length > 0) {
        var circularText = document.getElementById("myCircularText");

        circularText.addEventListener("click", function () {
            // Scroll the page down by 200px
            window.scrollBy(0, 400);
        });
    }
});

// dropdown open when hover over caret
$(document).ready(function () {

    if (window.innerWidth > 992) {

        $('header .nav-link').hover(function () {
            $(this).closest('.nav-link').siblings('ul').css('display', 'block');
        });

    }
    else {

        $('.main-caret').click(function () {
            var $ul = $(this).closest('.nav-link').siblings('ul');

            if ($ul.css('display') === 'block') {
                $ul.css('display', 'none');
            } else {
                $ul.css('display', 'block');
            }
        });

        $('.fa-caret-down:not(.main-caret)').click(function () {
            var $ul = $(this).closest('span').siblings('ul');
            if (!$ul.data('toggled')) {
                $ul.css('display', 'block');
                $ul.data('toggled', true);
            } else {
                $ul.toggle(); // Toggle the visibility of the ul element
            }
        });

    }

    $('.nav-item').mouseleave(function () {
        $(this).children('ul').first().css('display', 'none');
    });

    $('.main-caret').click(function (event) {
        event.preventDefault();
    });
});
