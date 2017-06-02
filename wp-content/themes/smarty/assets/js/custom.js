(function ($) {
    "use strict";

    // View Port
    $.fn.is_on_screen = function () {
        var win = $(window);

        var viewport = {
            top: win.scrollTop(),
            left: win.scrollLeft()
        };

        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    };

    // Content Offset Width
    function contentOffsetWidth(){
        var offsetWidth  = ( $(window).width() - $(".container").width() ) / 2;
        return offsetWidth;
    }

    // Header - Sub Menu
    function subMenuShowSide() {
        if( $('.stm-nav__menu_type_header > li > .sub-menu, .stm-nav__menu_type_header > li > .sub-menu .sub-menu').length ) {
            $('.stm-nav__menu_type_header > li > .sub-menu, .stm-nav__menu_type_header > li > .sub-menu .sub-menu').each(function() {
                var $this = $(this),
                    subMenuPos = $this.outerWidth() + $this.offset().left;

                if( subMenuPos > ($(window).outerWidth() - 15) ) {
                    $this.addClass("sub-menu_show_to-left");
                }
            });
        }
    }

    $(document).ready(function() {
        //Pricing Table
        $(".stm-pricing-table").hover(
            function() {
                $(this).addClass("stm-pricing-table_featured");
                $(".stm-pricing__tables-col").addClass("stm-pricing__tables-col_featured");
            }, function() {
                $(this).removeClass("stm-pricing-table_featured");
                $(".stm-pricing__tables-col").removeClass("stm-pricing__tables-col_featured");
            }
        );

        $(".stm-nav__menu .menu-item-has-children").mouseenter(function(){
            $(".stm-nav__menu li").removeClass("general__position");
            $(this).addClass("general__position");
        });

        // Revolution Slider - Left Shape
        if( $(".leftFullHeightBgDarkBlue").length ) {
            var revSlider = $(".leftFullHeightBgDarkBlue").closest(".rev_slider");

            if (window.matchMedia("(min-width: 767px)").matches) {
                revSlider.bind("revolution.slide.onloaded", function (e) {
                    $(".leftFullHeightBgDarkBlue").parent().addClass("leftFullHeightWrapper");

                    $(this).find(".leftFullHeightBgDarkBlue").each(function () {
                        var $this = $(this),
                            bgWidth = parseInt($(this).data("width")) + parseInt(contentOffsetWidth());

                        $this.parent(".leftFullHeightWrapper").css({
                            "min-width": bgWidth + "px",
                            "max-width": bgWidth + "px"
                        });
                    });
                });
            } else if( window.matchMedia("(max-width: 768px)").matches && !window.matchMedia("(max-width: 480px)").matches ) {
                revSlider.bind("revolution.slide.onloaded", function (e) {
                    $(".leftFullHeightBgDarkBlue").parent().addClass("leftFullHeightWrapper");

                    $(this).find(".leftFullHeightBgDarkBlue").each(function () {
                        $(this).parent(".leftFullHeightWrapper").css({
                            "min-width": ($(window).width() / 2) + "px",
                            "max-width": ($(window).width() / 2) + "px"
                        });
                    });
                });
            } else {
                revSlider.bind("revolution.slide.onloaded", function (e) {
                    $(".leftFullHeightBgDarkBlue").parent().addClass("leftFullHeightWrapper");

                    $(this).find(".leftFullHeightBgDarkBlue").each(function () {
                        $(this).parent(".leftFullHeightWrapper").css({
                            "min-width": $(window).width(),
                            "max-width": $(window).width()
                        });
                    });
                });
            }
        }
    });

    // Revolution STM Navigation
    $(document).on("click", ".stm-rev-nav_next", function() {
        $(this).closest(".rev_slider").revnext();

        return false;
    });

    $(document).on("click", ".stm-rev-nav_prev", function() {
        $(this).closest(".rev_slider").revprev();

        return false;
    });

    $(window).on("resize", function() {
        // Revolution Slider - Left Shape
        if( $(".leftFullHeightBgDarkBlue").length ) {
            if (!window.matchMedia("(max-width: 480px)").matches) {
                $(".leftFullHeightBgDarkBlue").each(function () {
                    var $this = $(this),
                        bgWidth = parseInt($(this).data("width")) + parseInt(contentOffsetWidth());

                    $(this).parent(".tp-mask-wrap").css({
                        "min-width": bgWidth,
                        "max-width": bgWidth
                    });
                });
            } else {
                $(".leftFullHeightBgDarkBlue").parent().addClass("leftFullHeightWrapper");

                $(this).find(".leftFullHeightBgDarkBlue").each(function () {
                    $(this).parent(".leftFullHeightWrapper").css({
                        "min-width": $(window).width(),
                        "max-width": $(window).width()
                    });
                });
            }
        }
    });

    // Button - Style
    function smartyBtnStyle(el) {
        var cssProperty = {},
            $this = $(el),
            $btnIcon = $this.find("i"),
            iconCssProperty = {};

        //$this.removeAttr('style');
        //$btnIcon.removeAttr('style');

        if( $this.data('bg') ) {
            cssProperty['background-color'] = $this.data('bg');
        }

        if( $this.data('border') ) {
            cssProperty['border-color'] = $this.data('border');
        }

        if( $this.data('text') ) {
            cssProperty['color'] = $this.data('text');
        }

        $this.css(cssProperty);

        if( $this.data('icon') ) {
            iconCssProperty['color'] = $this.data('icon');
        }

        $btnIcon.css(iconCssProperty);
    }

    // Big Button - Style
    function smartyBtnBigStyle(el) {
        var cssProperty = {},
            $this = $(el),
            $btnIcon = $this.find("i"),
            $btnText = $this.find(".stm-btn-big__text"),
            $btnSecondaryText = $this.find(".stm-btn-big__secondary-text"),
            iconCssProperty = {},
            textCssProperty = {},
            secondaryTextCssProperty = {};

        $this.removeAttr('style');
        $btnIcon.removeAttr('style');

        if( $this.data('bg') ) {
            cssProperty['background-color'] = $this.data('bg');
        }

        if( $this.data('border') ) {
            cssProperty['border-color'] = $this.data('border');
        }

        $this.css(cssProperty);

        if( $this.data('text') ) {
            textCssProperty['color'] = $this.data('text');
        }

        $btnText.css(textCssProperty);

        if( $this.data('s-text') ) {
            secondaryTextCssProperty['color'] = $this.data('s-text');
        }

        $btnSecondaryText.css(textCssProperty);

        if( $this.data('icon') ) {
            iconCssProperty['color'] = $this.data('icon');
        }

        $btnIcon.css(iconCssProperty);

    }

    $(document).ready(function() {
        // Smt Title Position
        $( window ).load(function() {
            $(".wrap-title-box").each(function() {
                var $minHeight = 75;
                if ( $(this).height() > $minHeight) {
                    $(this).addClass('wrap-title-box-long');
                }else {
                    $(this).removeClass('wrap-title-box-long');
                }
            });
        });

        $( window ).resize(function() {
            $(".wrap-title-box").each(function() {
                var $minHeight = 75;
                if ( $(this).height() > $minHeight) {
                    $(this).addClass('wrap-title-box-long');
                }else {
                    $(this).removeClass('wrap-title-box-long');
                }
            });
        });

        // Woocommerce Product Category
        $("ul.products li.product").each(function(){
            $(this).find(".woocommerce_product__category").insertBefore($(this).find(".woocommerce-LoopProduct-link h5"));
        });

        // Offset right
        if( $(".stm-offset-right").length ) {
            $(".stm-offset-right").css('margin-right', '-' + contentOffsetWidth() + 'px');
        }

        // Offset left
        if( $(".stm-offset-left").length ) {
            $(".stm-offset-left").css('margin-left', '-' + contentOffsetWidth() + 'px');
        }

        // Header - Sub Menu
        subMenuShowSide();

        // Select 2
        if( $('select').length ) {
            $('select').select2({
                minimumResultsForSearch: '-1'
            });
        }

        // Widget - Categories
        if( $(".widget_categories").length ) {
            $(".widget_categories").each(function() {
               if( $(this).find('select').length ) {
                   $(this).addClass("widget_categories_type_dropdown");
               }
            });
        }

        // Contact Details
        if( ! window.matchMedia("(max-width: 767px)").matches ) {
            if( $(".vc_row-no-padding .stm-map .stm-contact-details").length ) {
                $(".vc_row-no-padding .stm-map .stm-contact-details").css({
                    left : contentOffsetWidth() + "px"
                });
            }
        } else {
            if( $(".vc_row-no-padding .stm-map .stm-contact-details").length ) {
                $(".vc_row-no-padding .stm-map .stm-contact-details").css("left", "");
            }
        }

        $(window).resize(function() {
            if( ! window.matchMedia("(max-width: 767px)").matches ) {
                if( $(".vc_row-no-padding .stm-map .stm-contact-details").length ) {
                    $(".vc_row-no-padding .stm-map .stm-contact-details").css({
                        left : contentOffsetWidth() + "px"
                    });
                }

            } else {
                if( $(".vc_row-no-padding .stm-map .stm-contact-details").length ) {
                    $(".vc_row-no-padding .stm-map .stm-contact-details").css("left", "");
                }
            }
        });

        // FancyBox
        if( $(".stm-fancybox").length ) {
            $(".stm-fancybox").fancybox({
                maxWidth	: '70%',
                maxHeight	: '70%',
                autoSize	: false,
                padding     : 0,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none',
                beforeLoad: function() {
                    if( $(this.element).attr("audio-height") ) {
                        this.height = $(this.element).attr("audio-height");
                    }
                }
            });
        }

        // Courses Form
        if( $(".courses__form").length ) {
            $(".courses__form").fancybox({
                padding     : 0
            });
        }

        // Button - Custom
        if( $(".stm-btn_custom").length ) {

            $(".stm-btn_custom").each(function() {
                smartyBtnStyle(this);
            });

            $(".stm-btn_custom").on('mouseenter', function() {
                var cssProperty = {},
                    $this = $(this),
                    $btnIcon = $this.find("i"),
                    iconCssProperty = {};

                if( ! $this.hasClass('stm-btn_disabled') ) {

                    if ($this.data('bg-hover')) {
                        cssProperty['background-color'] = $this.data('bg-hover');
                    }

                    if ($this.data('border-hover')) {
                        cssProperty['border-color'] = $this.data('border-hover');
                    }

                    if ($this.data('text-hover')) {
                        cssProperty['color'] = $this.data('text-hover');
                    }

                    $this.css(cssProperty);

                    if ($this.data('icon-hover')) {
                        iconCssProperty['color'] = $this.data('icon-hover');
                    }

                    $btnIcon.css(iconCssProperty);
                }
            });

            $(".stm-btn_custom").on('mouseleave', function() {
                smartyBtnStyle(this);
            });

            $(".stm-btn_custom").on('mousedown', function() {
                var cssProperty = {},
                    $this = $(this),
                    $btnIcon = $this.find("i"),
                    iconCssProperty = {};

                if( ! $this.hasClass('stm-btn_disabled') ) {
                    if( $this.data('bg-active') ) {
                        cssProperty['background-color'] = $this.data('bg-active');
                    }

                    if( $this.data('border-active') ) {
                        cssProperty['border-color'] = $this.data('border-active');
                    } else {
                        cssProperty['border-color'] = $this.data('bg-active');
                    }

                    if( $this.data('text-active') ) {
                        cssProperty['color'] = $this.data('text-active');
                    }

                    if( $this.data('icon-active') ) {
                        iconCssProperty['color'] = $this.data('icon-active');
                    }

                    $btnIcon.css(iconCssProperty);

                    $this.css(cssProperty);
                }
            });
        }

        // Big Button - Custom
        if( $(".stm-btn-big_custom").length ) {

            $(".stm-btn-big_custom").each(function() {
                smartyBtnBigStyle(this);
            });

            $(".stm-btn-big_custom").on('mouseenter', function() {
                var cssProperty = {},
                    $this = $(this),
                    $btnIcon = $this.find("i"),
                    $btnText = $this.find(".stm-btn-big__text"),
                    $btnSecondaryText = $this.find(".stm-btn-big__secondary-text"),
                    iconCssProperty = {},
                    textCssProperty = {},
                    secondaryTextCssProperty = {};

                if ($this.data('bg-hover')) {
                    cssProperty['background-color'] = $this.data('bg-hover');
                }

                if ($this.data('border-hover')) {
                    cssProperty['border-color'] = $this.data('border-hover');
                }

                $this.css(cssProperty);

                if ($this.data('text-hover')) {
                    textCssProperty['color'] = $this.data('text-hover');
                }

                $btnText.css(textCssProperty);

                if ($this.data('s-text-hover')) {
                    secondaryTextCssProperty['color'] = $this.data('s-text-hover');
                }

                $btnSecondaryText.css(secondaryTextCssProperty);

                if ($this.data('icon-hover')) {
                    iconCssProperty['color'] = $this.data('icon-hover');
                }

                $btnIcon.css(iconCssProperty);
            });

            $(".stm-btn-big_custom").on('mouseleave', function() {
                smartyBtnBigStyle(this);
            });

            $(".stm-btn-big_custom").on('mousedown', function() {
                var cssProperty = {},
                    $this = $(this),
                    $btnIcon = $this.find("i"),
                    $btnText = $this.find(".stm-btn-big__text"),
                    $btnSecondaryText = $this.find(".stm-btn-big__secondary-text"),
                    iconCssProperty = {},
                    textCssProperty = {},
                    secondaryTextCssProperty = {};

                if ($this.data('bg-active')) {
                    cssProperty['background-color'] = $this.data('bg-active');
                }

                if ($this.data('border-active')) {
                    cssProperty['border-color'] = $this.data('border-active');
                }

                $this.css(cssProperty);

                if ($this.data('text-active')) {
                    textCssProperty['color'] = $this.data('text-active');
                }

                $btnText.css(textCssProperty);

                if ($this.data('s-text-active')) {
                    secondaryTextCssProperty['color'] = $this.data('s-text-active');
                }

                $btnSecondaryText.css(secondaryTextCssProperty);

                if ($this.data('icon-active')) {
                    iconCssProperty['color'] = $this.data('icon-active');
                }

                $btnIcon.css(iconCssProperty);
            });
        }
    });

    $(window).resize(function() {
       // Header - Sub Menu
       subMenuShowSide();

       // Contact Details
       if( $(".vc_row-no-padding .stm-map .stm-contact-details").length ) {
           $(".vc_row-no-padding .stm-map .stm-contact-details").css({
               left : contentOffsetWidth() + "px"
           });
       }
    });

    // Donation
    $('.form_donation').on('submit', function () {
        var $this = $(this);
        $($this).removeClass('error');
        $($this).find('.form__action-loading').addClass("form__action-loading_state_loading");
        $(this).ajaxSubmit({
            url: window.wp_data.ajax_url,
            dataType: 'json',
            success: function (data) {
                $($this).find('.form__action-loading').removeClass("form__action-loading_state_loading");
                if (data['success']) {
                    top.location.href = data['success'];
                } else {
                    for (var k in data['errors']) {
                        $($this).find('input[name="donor[' + k + ']"]').addClass('error');
                        $($this).find('.form-error_' + k + '').html(data['errors'][k]).addClass('active');
                    }
                }
            }
        });

        $($this).find('.error').live('change', function () {
            if( $(this).val() !== '' ) {
                $(this).removeClass('error');
                $(this).closest('.form__item').find(".form-error").removeClass("active");
            }
        });

        return false;
    });

    $(document).on("click", ".form_donation .form__amount-label", function() {
        $(this).addClass("active").siblings().removeClass("active");
        $(this).closest('form').find('.form__amount-value-custom').val("");
    });

    $(document).on("change", ".form_donation .form__amount-value-custom", function() {
        $(this).closest("form").find(".form__amount-label").each(function() {
            $(this).removeClass("active");
        });
    });

    // Join Event
    $('.form_join-event').on('submit', function () {
        console.log(window.wp_data.ajax_url);
        var $this = $(this),
            eventID = parseInt($($this).find('input[name="event_member[event_id]"]').val()),
            addedEvents = localStorage.getItem( 'addedEvents'),
            eventAdded = false;

        if( addedEvents ) {
            addedEvents = JSON.parse(addedEvents);
            eventAdded = $.inArray(eventID, addedEvents) > -1;
        }

        if( ! eventAdded ) {
            $($this).removeClass('error');
            $($this).find('.form__loading').addClass("form__loading_state_active");
            $(this).ajaxSubmit({
                url: window.wp_data.ajax_url,
                dataType: 'json',
                success: function (data) {
                    $($this).find('.form__loading').removeClass("form__loading_state_active");
                    if (data['success']) {
                        $(".event-attended-count").text( parseInt( $(".event-attended-count").text() ) + 1 );
                        if( addedEvents ) {
                            addedEvents.push(eventID);
                        } else {
                            addedEvents = [eventID];
                        }
                        localStorage.setItem( 'addedEvents', JSON.stringify(addedEvents) );
                        $($this).find(".form__notice_success").fadeIn(300);
                    } else {
                        for (var k in data['errors']) {
                            $($this).find('input[name="event_member[' + k + ']"]').addClass('error');
                            $($this).find('textarea[name="event_member[' + k + ']"]').addClass('error');
                        }
                    }
                }
            });

            $($this).find('.error').live('change', function () {
                if( $(this).val() !== '' ) {
                    $(this).removeClass('error');
                }
            });
        } else {
            $($this).find(".form__notice_information").fadeIn(300);
        }

        return false;
    });

    // Notice
    $(document).on("click", ".notice__hide", function() {
       $(this).closest('.notice').fadeOut(300);
    });

    // Quantity control
    $(document).on('click', '.quantity-control', function(e) {
        e.preventDefault();
        var $quantity = $(this).parent().find('input'),
            quantityVal = $quantity.val();

        if( $(this).hasClass("quantity-control_plus") ) {
            quantityVal = parseInt( quantityVal ) + 1;
            $quantity.val( quantityVal );
        } else if( quantityVal > 1 ) {
            quantityVal = parseInt( quantityVal ) - 1;
            $quantity.val( quantityVal );
        }
    });

    // Top Bar - Search
    $(document).on("click", ".top-bar__search .stm-search-form__submit", function() {
        var $this = $(this),
            $topBar = $this.closest(".top-bar"),
            $headerBar = $this.closest(".header"),
            $searchHeadMenuBox = $this.closest(".stm-search-form").parents(".header_view-style_1").find(".stm-nav"),
            $searchFormBoxed = $this.closest(".stm-search-form").parents(".header_view-style_1").find(".nav_menu_indent"),
            $searchFieldForm = $this.closest(".header_view-style_1 .top-bar__search"),
            $searchField = $this.closest(".stm-search-form").find(".stm-search-form__field");
        if ( $topBar.hasClass("top-bar_view-style_1") && ! $searchField.hasClass( "stm-search-form__field_active" ) || $topBar.hasClass("top-bar_view-style_2") && ! $searchField.hasClass( "stm-search-form__field_active" ) || $topBar.hasClass("top-bar_view-style_3") && ! $searchField.hasClass( "stm-search-form__field_active" ) || $topBar.hasClass( "top-bar_view-style_4" ) && ! $searchField.hasClass( "stm-search-form__field_active" ) ) {
            $searchField.addClass("stm-search-form__field_active").focus();
            return false;
        }
        if ( $headerBar.hasClass("header_view-style_1") && ! $searchField.hasClass( "stm-search-form__field_active" ) ) {
            $searchHeadMenuBox.addClass("stm-search-form__field_active_menu").focus();
            $searchFormBoxed.animate({width: '10px'}, 230).focus();
            $searchFieldForm.addClass("stm-search-form__field_active").focus();
            $searchField.addClass("stm-search-form__field_active").focus();
            return false;
        }

        if( ! $searchField.val() ) {
            $searchField.focus();
            return false;
        }
    });

    $(document).on("keypress", ".stm-search-form__field_active, .top-bar_view-style_1 .stm-search-form__field", function() {
        var $this = $(this),
            $button = $this.closest(".top-bar__search").find(".stm-search-form__submit");

        $button.addClass("stm-search-form__submit_active");
    });

    $(document).on("keypress", ".widget.widget_search .stm-search-form__field", function() {
        var $this = $(this),
            $button = $this.closest(".widget.widget_search").find(".stm-search-form__submit");

        $button.addClass("stm-search-form__submit_active");
    });

    $(document).on("keypress", ".woocommerce-product-search .search-field", function() {
        var $this = $(this),
            $button = $this.closest(".woocommerce-product-search");

        $button.addClass("stm-search-form__submit_active");
    });

    $('body').on("click", function(e) {
        if( ! $(e.target).closest(".top-bar__search .stm-search-form").length ) {
            setTimeout(function(){
                $(".header_view-style_1 .stm-nav").removeClass("stm-search-form__field_active_menu");
            }, 200);
            $(".header_view-style_1 .top-bar__search").removeClass("stm-search-form__field_active");
            $(".nav_menu_indent").animate({width: '76px'}, 230);
            $(".top-bar__search .stm-search-form__field_active").removeClass("stm-search-form__field_active").val('');
            $(".top-bar__search .stm-search-form__submit_active").removeClass("stm-search-form__submit_active");
            $(".widget.widget_search .stm-search-form__submit").removeClass("stm-search-form__submit_active");
            $(".woocommerce-product-search").removeClass("stm-search-form__submit_active");
        }
    });

    // Mobile - Nav Menu
    $(document).on("click", ".header-mobile__nav-control", function() {
        var $mobileNav = $(".stm-nav_type_mobile-header");

        if( $mobileNav.length ) {
            if( $mobileNav.css("display") == 'none' ) {
                $mobileNav.slideDown();
                $(this).addClass("active");
            } else {
                $mobileNav.slideUp();
                $mobileNav.find("ul li ul").slideUp();
                $mobileNav.find("ul li").removeClass("active");
                $(this).removeClass("active");
            }
        }
    });

    $(document).on("click", ".stm-nav__menu_type_mobile-header a", function() {
        if( $(this).parent("li").hasClass("menu-item-has-children") && ! $(this).parent("li").hasClass("active") ) {

            $(this).closest("li").siblings().find("ul").slideUp();
            $(this).closest("li").siblings().find("li").removeClass("active");

            $(this).next("ul").slideDown();
            $(this).parent("li").addClass("active").siblings().removeClass("active");

            return false;
        }
    });

})(jQuery);