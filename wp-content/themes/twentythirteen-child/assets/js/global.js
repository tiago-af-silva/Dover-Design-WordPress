$(document).ready(function () {

    // Global Nav 
    $(".wrap_menu_button").click(function(){
        $(".header").toggleClass("header_on");
        $(".header_nav").toggleClass("nav_active");
        $(".menu_button").toggleClass("on");
    });

    // archive section - work page
    $(".archive_btn").click(function(){
        $(".work__cell.more_proj").toggleClass("archived");
        $(".archive_btn.more").toggleClass("no_btn");
        $(".archive_btn.less").toggleClass("no_btn");
        $('.grid-archived').isotope('layout');
    });

    // work pop-up
    $(".close_btn").click(function(){
        $(".work_pop-up_wraper").addClass("no_pop-up");
        $(".wrapper").removeClass("no_scroll");
    });
    $(".case-study_btn").click(function(){
        $(".work_pop-up_wraper").removeClass("no_pop-up");
        $(".wrapper").addClass("no_scroll");
    });

    // Team pop-up
    $(".close_btn").click(function(){
        $(".pop-up_wraper").addClass("no_pop-up");
        $(".wrapper").removeClass("no_scroll");
    });

    $(".pop-1").click(function(){
        $(".pop-up_1").removeClass("no_pop-up");
        $(".wrapper").addClass("no_scroll");
    });

    $(".pop-2").click(function(){
        $(".pop-up_2").removeClass("no_pop-up");
        $(".wrapper").addClass("no_scroll");
    });

    $(".pop-3").click(function(){
        $(".pop-up_3").removeClass("no_pop-up");
        $(".wrapper").addClass("no_scroll");
    });

    $(".consultation_slot_day").click(function () {
        var day = $(this).attr("data-day");
        $(".consultation_slot_day").hide();
        $("#consultation_slot_" + day).show();
    });

    $(".consultation_slot_hour").click(function () {
        var value = $(this).attr("data-value");
        $("#consultation_slot").val(value);
        $(".consultation_slot_hour").addClass("inactive");
        $(this).removeClass("inactive");
    });

    $(".consultation_slot_day_cancel").click(function (e) {
        e.preventDefault();
        $("#consultation_slot").val("");
        $(".consultation_slot_hour_list").hide();
        $(".consultation_slot_hour").removeClass("inactive");
        $(".consultation_slot_day").show();
        return false;
    });

    if ($("#consultation_slot").val()) {
        var value = $("#consultation_slot").val();
        $(".consultation_slot_hour").addClass("inactive");
        $(".consultation_slot_hour[data-value='" + value + "']").removeClass("inactive");
        $(".consultation_slot_day").hide();
        $(".consultation_slot_hour[data-value='" + value + "']").parents('.consultation_slot_hour_list').first().show();
    }

    // Remove rollover

    if ('ontouchstart' in document.documentElement) {
        // Add .touch class
        $('body').addClass('touch');
        
        try {
            var ignore = /:hover/;

            function removeRules(sheet) {
                for (var j = sheet.cssRules.length - 1; j >= 0; j--) {
                    var rule = sheet.cssRules[j];
                    if (rule.type === CSSRule.MEDIA_RULE) {
                        removeRules(rule);
                    } else if (rule.type === CSSRule.STYLE_RULE) {
                        if (ignore.test(rule.selectorText)) {
                            sheet.deleteRule(j);
                        }
                    }
                }
            }

            for (var i = 0; i < document.styleSheets.length; i++) {
                var sheet = document.styleSheets[i];
                if (!sheet.cssRules) {
                    continue;
                }
                
                removeRules(sheet);
            }
        } catch (e) {}
    }

});
