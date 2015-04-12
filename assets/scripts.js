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
        currentActiveElement : null,
        activeSlide: null,
        /**
         * Selector container
         */
        _elements: {
            wrapper: "#zt-slidershow-wrapper",
            slides: "#zt-slidershow-container",
            slide: "#zt-slidershow-element",
            dragable: "#zt-slideshow-dragable",
            deleteModal: "#zt-slidershow-modal-confirm",
            canNotDeleteModal: "#zt-slidershow-modal-cannotdelete"
        },
        reinitSqueezeBox: function(){
            w.SqueezeBox.initialize({});
            w.SqueezeBox.assign($('a.modal').get(), {
                parse: 'rel'
            });  
        },
        _texts: {
            ZT_SLIDESHOW_CANT_REMOVE: "Slider need at least one slide."
        },
        activeElement: function(element){
            this.currentActiveElement = $(element);
        },
        /**
         * Select internal elements
         * @param {type} selector
         * @returns {undefined}
         */
        _selectElement: function (selector) {
            return $(this._elements.wrapper).find(selector);
        },
        /*
         * Init jQuery UI sortable
         * @returns {undefined}
         */
        hookSortable: function () {
            var _self = this;
            this._selectElement(this._elements.slides).sortable({
                handle: _self._elements.dragable,
                placeholder: "sortable-hightligth"
            }).disableSelection();
        },
        /**
         * Flush sortable elements
         */
        flushSortable: function () {
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
            $cloned.find('.slider-content').css('display', 'none');
            $cloned.find('.chzn-container').remove();
            $cloned
                    .find('.slider-accordion')
                    .find('i')
                    .first()
                    .removeClass('fa-minus')
                    .addClass('fa-plus');
            $cloned.find('input').val('');
            $cloned.find('select').val('').trigger("liszt:updated");
            $cloned.appendTo($sliderContainer);
            $sliderContainer.find('.added select')
                    .chosen();
            $sliderContainer.find('.added').removeClass('added');
            /* Reload sortable list */
            this.hookSortable();
            this.reinitSqueezeBox();
        },
        showModalDelete: function(el){
            if (this._selectElement(this._elements.slides)
                .find('div' + this._elements.slide).length <= 1) {
                $(this._elements.canNotDeleteModal).modal('show');
                return false;
            }
            $(this._elements.deleteModal).modal('show');
            this.activeSlide = el;
        },
        /**
         * Delete and slide
         * @returns {undefined}
         */
        deleteSlide: function () {
            var el = this.activeSlide;

            this.flushSortable();
            var $parentEl = $(el).closest(this._elements.slide);
            /* Add slide up animation */
            $($parentEl).slideUp(function () {
                $(this).remove();
            });
            $(this._elements.deleteModal).modal('hide');
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
            this.generateSlidesJSON();
        },
        generateSlidesJSON: function () {
            var $slides = $(this._elements.slide);
            var list = [];
            $($slides).each(function () {
                var map = {};
                $(this).find("input").each(function () {
                    if ($(this).attr('type') == 'radio') {
                        if ($(this).is(':checked')) {
                            map[$(this).attr("name")] = $(this).val();
                        }
                    } else {
                        map[$(this).attr("name")] = $(this).val();
                    }

                });
                $(this).find("textarea").each(function () {
                    map[$(this).attr("name")] = $(this).val();
                });
                $(this).find("select").each(function () {
                    map[$(this).attr("name")] = $(this).val();
                });
                map['l-position'] = $(this).find('.left.position-item.active').data('value');
                map['r-position'] = $(this).find('.right.position-item.active').data('value')
                list.push(map);
            });
            var json = JSON.stringify(list);
            $('#slides').val(json);
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