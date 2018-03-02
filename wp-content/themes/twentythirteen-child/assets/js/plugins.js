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

function filter_grid(button_element, grid_class) {
    if (!button_element || !grid_class) {
        return false;
    }

    var filter_value = button_element.attr('data-filter');

    if (!filter_value) {
        filter_value = '*';
    }

    $(grid_class).isotope({
        filter: filter_value
    });

    button_element.parent().find('.is-checked').removeClass('is-checked');
    button_element.addClass('is-checked');
}

$(document).ready(function () {
    // Homepage carousel
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
                // Hide all text boxes except for the ones that are not delayed
                slider.$slider.find('.slide_delayed .cell').hide();

                // Apply the zoom effect to the current image
                slider.$slider.find('.slide').eq(0).find('.image').addClass('zoom');

                slickSlider = slider.$slider;
            },
            onBeforeChange: function (slider, currentIndex, targetIndex) {
                // Hide all text boxes
                slider.$slider.find('.slide_delayed .cell').hide();
            },
            onAfterChange: function (slider, index) {
                var this_slide = slider.$slider.find('.slide').eq(index);

                // Show text box for the slide that we switched on to
                if (this_slide.hasClass('slide_delayed')) {
                    setTimeout(function () {
                        this_slide.find('.cell').show();
                    }, 2000);
                }

                // Apply the zoom effect to the current image
                slider.$slider.find('.slide .image.zoom').removeClass('zoom');
                this_slide.find('.image').addClass('zoom');
            }
        });
    }

    // Grid on the work page
    if ($('.filter_nav').length > 0 && $('.grid').length > 0) {
        var filter_buttons = $('.filter_nav .filter_nav_item');

        // Bind filter buttons
        filter_buttons.on('click', function () {
            filter_grid($(this), '.grid');
        });

        // Initial filtering
        filter_grid(filter_buttons.first(), '.grid');
    }
});
