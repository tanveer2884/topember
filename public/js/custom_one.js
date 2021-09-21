// for quantity input

(function() {

    window.inputNumber = function(el) {

        var min = el.attr('min') || false;
        var max = el.attr('max') || false;

        var els = {};

        els.dec = el.prev();
        els.inc = el.next();

        el.each(function() {
            init($(this));
        });

        function init(el) {

            els.dec.on('click', decrement);
            els.inc.on('click', increment);

            function decrement() {
                var value = el[0].value;
                value--;
                if (!min || value >= min) {
                    el[0].value = value;
                }
            }

            function increment() {
                var value = el[0].value;
                value++;
                if (!max || value <= max) {
                    el[0].value = value++;
                }
            }
        }
    }
})();

// inputNumber($('.input-number'));

$('.input-number-decrement').click(function() {
    var qtyval = $(this).next().val();
    if(qtyval!=1) {
        qtyval-=1;
    }
    $(this).next().val(qtyval);
    console.log(qtyval);
});

$('.input-number-increment').click(function() {
    var qtyval = $(this).prev().val();
    qtyval = parseInt(qtyval);
    qtyval += 1;
    $(this).prev().val(qtyval);
    console.log(qtyval);
});

// price-filter

// filter price
var lowerSlider = document.querySelector('#lower');
var upperSlider = document.querySelector('#upper');

document.querySelector('#two').value = upperSlider.value;
document.querySelector('#one').value = lowerSlider.value;

var lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);

upperSlider.oninput = function() {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);

    if (upperVal < lowerVal + 4) {
        lowerSlider.value = upperVal - 4;
        if (lowerVal == lowerSlider.min) {
            upperSlider.value = 4;
        }
    }
    document.querySelector('#two').value = this.value
};

lowerSlider.oninput = function() {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    if (lowerVal > upperVal - 4) {
        upperSlider.value = lowerVal + 4;
        if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 4;
        }
    }
    document.querySelector('#one').value = this.value
};
// for services input
function showInput() {
    let showSearch = document.getElementById('nw-txt-area-Two');
    showSearch.classList.toggle('d-block');
}
// for track order input
function showInputTwo() {
    let showSearch = document.getElementById('nw-txt-area-Three');
    showSearch.classList.toggle('d-block');
}
// scroll animation
$(function() {
    $('a[href*=\\#]:not([href=\\#])').on('click', function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) + ']');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
            return false;
        }
    });
});
// scroll animation