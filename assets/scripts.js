function setActive(el) {
    jQuery(el).toggleClass('select-image-focused');
}

/**
 *
 * @param {type} w
 * @param {type} $
 * @returns {undefined}
 */
(function (w, $) {

    /* Short code main class */
    var _slideshow = {
        _init: function () {
            this.hookSortable();
            this.selectPosition();
        },
        /**
         * Selector container
         */
        _elements: {
            wrapper: "#zt-slidershow-wrapper",
            slides: "#zt-slidershow-container",
            slide: "#zt-slidershow-element"
        },
        _texts: {
            ZT_SLIDESHOW_CANT_REMOVE: "Slider need at least one slide."
        },
        /**
         * Select internal elements
         * @param {type} selector
         * @returns {undefined}
         */
        _selectElement: function(selector){
            return $(this._elements.wrapper).find(selector);
        },
        /*
         * Init jQuery UI sortable
         * @returns {undefined}
         */
        hookSortable: function () {
            var $sliderContainer = this._selectElement(this._elements.slides);
            $sliderContainer.sortable();
            $sliderContainer.disableSelection();
        },
        /**
         * Flush sortable elements
         */
        flushSortable: function(){
            this._selectElement(this._elements.slides).sortable("destroy");
        },
        /**
         * Clone the first slide and add to list
         * @param {type} el
         * @returns {undefined}
         */
        addSlide: function () {
            /* Note: Flush sortable after you reload it */
            this.flushSortable();
            var $sliderContainer = this._selectElement(this._elements.slides);
            var $parentEl = this._selectElement(this._elements.slide).first();
            var $cloned = $parentEl.clone();
            $cloned.addClass('added');
            $cloned.find('.chzn-done').removeClass('chzn-done');
            $cloned.find('.chzn-container').remove();
            $cloned.find('input').val('');
            $cloned.find('select').val('').trigger("liszt:updated");
            $cloned.appendTo($sliderContainer);
            $sliderContainer.find('.added select')
                    .chosen();
            /* Reload sortable list */
            this.hookSortable();
        },
        /**
         * Delete and slide
         * @param {type} el
         * @returns {undefined}
         */
        deleteSlide: function (el) {
            if(this._selectElement(this._elements.slides)
                    .find('div'+this._elements.slide).length <= 1){
                        alert(this._texts.ZT_SLIDESHOW_CANT_REMOVE);
                        return false;
                    }
            this.flushSortable();
            var $parentEl = $(el).closest(this._elements.slide);
            /* Add slide up animation */
            $($parentEl).slideUp(function(){
                $(this).remove();
            });
            this.hookSortable();
        },
        /**
         *
         */
        backgroundToggle: function (el) {
            var $valueToggle = $(el).val();
            $(el).closest('.slider-toggle').find('.slider-element').slideUp();
            $(el).closest('.slider-toggle').find('#toggle-' + $valueToggle).slideDown();
        },
        /**
         *
         */
        typeToggle: function (el) {
            var $valueType = $(el).val();
            $(el).closest('.element-position').find('.element-toggle').slideUp();
            $(el).closest('.element-position').find('.slide-' + $valueType).slideDown();
        },
        /**
         *
         */
        sliderAccordion: function (el) {
            var $sliderContent = $(el).closest('.slider-accordion').next();
            if ($sliderContent.is(':visible')) {
                $sliderContent.slideUp();
                $(el).removeClass('fa-minus').addClass('fa-plus');
            } else {
                $sliderContent.slideDown();
                $(el).removeClass('fa-plus').addClass('fa-minus');
            }
        },
        /**
         *
         */
        selectPosition: function (el) {
            $(el).closest('.slider-position').find('li').removeClass('active');
            $(el).addClass('active');
        },
        /**
         *
         * @returns {undefined}
         */
        hookSave: function () {
            zo2.modules.slideshow.generateSlidesJSON();
        },
        generateSlidesJSON: function () {
            var $slides = jQuery(this._elements.slide);
            var list = [];
            jQuery($slides).each(function () {
                var map = {};
                jQuery(this).find("input").each(function () {
                    if (jQuery(this).attr('type') == 'radio') {
                        if (jQuery(this).is(':checked')) {
                            map[jQuery(this).attr("name")] = jQuery(this).val();
                        }
                    } else {
                        map[jQuery(this).attr("name")] = jQuery(this).val();
                    }

                });
                jQuery(this).find("textarea").each(function () {
                    map[jQuery(this).attr("name")] = jQuery(this).val();
                });
                jQuery(this).find("select").each(function () {
                    map[jQuery(this).attr("name")] = jQuery(this).val();
                });
                map['l-position'] = jQuery(this).find('.left.position-item.active').data('value');
                map['r-position'] = jQuery(this).find('.right.position-item.active').data('value')
                list.push(map);
            });
            var json = JSON.stringify(list);
            jQuery('#slides').val(json);
            console.log(list);
        }
    };
    /* Check for Zo2 javascript framework */
    if (typeof (w.zo2) === 'undefined') {
        w.zo2 = {};
    }
    /* Check for Zo2 modules */
    if (typeof (w.zo2.modules) === 'undefined') {
        w.zo2.modules = {};
    }
    /* Append zt slideshow module */
    w.zo2.modules.slideshow = _slideshow;
    /* Init */
    $(w.document).ready(function () {
        w.zo2.modules.slideshow._init();
    });
})(window, jQuery);