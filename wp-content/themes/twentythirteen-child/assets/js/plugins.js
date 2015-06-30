// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

$(document).ready(function () {
    //
    // Homepage carousel
    //
    if ($('.slideshow').length > 0) {
        $('.slideshow').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 1000,
            fade: true,
            slide: 'div',
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 12000,
            pauseOnHover: false,
            onInit: function (slider) {
                // Hide all text boxes
                slider.$slider.find('.cell').hide();

                // Show text box for the first slide (straighaway; no delay like for the other slides)
                slider.$slider.find('.slide').eq(0).find('.cell').show();

                // Apply the zoom effect to the current image
                slider.$slider.find('.slide').eq(0).find('.image').addClass('zoom');

                slickSlider = slider.$slider;
            },
            onBeforeChange: function (slider, index) {
                // Hide all text boxes
                slider.$slider.find('.cell').hide();
            },
            onAfterChange: function (slider, index) {
                // Show text box for the slide that we switched on to
                if (index > 0) {
                    slider.$slider.find('.slide').eq(index).find('.cell').show();
                } else {
                    setTimeout(function () {
                        slider.$slider.find('.slide').eq(index).find('.cell').show();
                    }, 2000);
                }

                // Apply the zoom effect to the current image
                slider.$slider.find('.slide .image.zoom').removeClass('zoom');
                slider.$slider.find('.slide').eq(index).find('.image').addClass('zoom');
            }
        });
    }

    // // Work details & Team grid
    // var container = document.querySelector('#masonry');
    // var msnry = new Masonry( container, {
    //   // columnWidth: 1,
    //   itemSelector: '.item',
    //   // gutter: 5
    // });

});
