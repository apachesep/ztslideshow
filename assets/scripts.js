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
            this.sortable();
            this.selectPosition();
        },
        /**
         * 
         */
        _elements: {
            slides: '.slides.sortable',
            slide: '.slides .slide'
        },
        sortable: function () {
            jQuery(this._elements.slides).sortable();
            jQuery(this._elements.slides).disableSelection();
        },
        /**
         * Clone last slide and add to list
         * @param {type} el
         * @returns {undefined}
         */
        addSlide: function () {
            var $parentEl = jQuery(this._elements.slide).last();
            var $cloned = jQuery($parentEl[0]).clone();
            jQuery($cloned).addClass('added');
            jQuery($cloned).find('.chzn-done').removeClass('chzn-done');
            jQuery($cloned).find('.chzn-container').remove();            
            jQuery($cloned).appendTo(this._elements.slides);
            jQuery('.added select').chosen();
            // Reload sortable list
            this.sortable();
        },
        /**
         *
         */
        backgroundToggle: function (el) {
            var $valueToggle = $(el).data('toggle');
            $(el).closest('.slider-toggle').find('.slider-element').slideUp();
            $(el).closest('.slider-toggle').find('#' + $valueToggle).slideDown();
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