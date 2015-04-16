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
            /* Remove conflict between bootstrap & ztslideshow */
            $('input[checked="checked"]').attr('checked', true);
        },
        currentActiveElement: null,
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
        /**
         * Reinit squeezebox
         * @returns {undefined}
         */
        reinitSqueezeBox: function () {
            w.SqueezeBox.initialize({});
            w.SqueezeBox.assign($('a.modal').get(), {
                parse: 'rel'
            });
        },
        /**
         * Set current active element
         * @param {type} element
         * @returns {undefined}
         */
        activeElement: function (element) {
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
                placeholder: "sortable-hightligth",
                stop: function (event, ui) {
                    _self.updateOrdering();
                }
            }).disableSelection();
        },
        /**
         * Flush sortable elements
         */
        flushSortable: function () {
            this._selectElement(this._elements.slides).sortable("destroy");
        },
        /**
         * Update ordering
         * @returns {undefined}
         */
        updateOrdering: function () {
            var $slides = $('div' + this._elements.slide);
            $slides.each(function () {
                var $currentElement = $(this);
                $currentElement
                    .find('> .slider-title')
                    .html('Slider ' + ($currentElement.index() + 1));
            });
        },
        /**
         * Clone the first slide and add to list
         * @returns {undefined}
         */
        addSlide: function () {
            /* Note: Flush sortable after you reload it */
            this.flushSortable();
            var _self = this;
            var $sliderContainer = this._selectElement(this._elements.slides);
            var $parentEl = this._selectElement(this._elements.slide).first();
            var $cloned = $parentEl.clone();
            /* Hight light it ! */
            $cloned.addClass('added');
            /* Clean up chosen */
            $cloned.find('.chzn-done').removeClass('chzn-done');
            $cloned.find('.slider-content').css('display', 'none');
            $cloned.find('.chzn-container').remove();
            /* Reset position */
            $cloned
                .find('div.slider-position')
                .find('li.active')
                .removeClass('active');
            /* Reset explain */
            $cloned
                .find('.slider-accordion')
                .find('i')
                .first()
                .removeClass('fa-minus')
                .addClass('fa-plus');
            /* Clean up input & selector */
            $cloned.find('textarea').val('');
            $cloned.find('input[type="text"]').val('');
            $cloned.find('select').val('').trigger('update');
            /* Add clone slide to child */
            $cloned.appendTo($sliderContainer);
            /* Apply chosen */
            $sliderContainer.find('.added select')
                .chosen();
            $sliderContainer.find('.added select')
                .each(function () {
                    var name = $(this).attr('name');
                    if (name === 'r-type' || name === 'l-type') {
                        _self.typeToggle($(this));
                    }
                });
            $sliderContainer.find('.added').removeClass('added');
            /* Reload sortable list */
            this.hookSortable();
            this.updateOrdering();
            this.reinitSqueezeBox();
        },
        showModalDelete: function (el) {
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
            var $btnGroup = $(el).closest('.btn-group');
            $btnGroup
                .find('.btn-success')
                .removeClass('btn-success');
            $btnGroup.find('.active')
                .removeClass('active');
            $(el).addClass('btn-success');
            $(el).closest('.slider-toggle').find('.slider-element').slideUp();
            $(el).closest('.slider-toggle').find('#toggle-' + $valueToggle).slideDown();
        },
        /**
         *
         */
        typeToggle: function (el) {
            var valueType = $(el).val();
            $(el).closest('.element-position').find('.element-toggle').slideUp();
            $(el).closest('.element-position').find('.slide-' + valueType).slideDown();
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
            var $slides = $('div' + this._elements.slide);
            var list = [];
            $($slides).each(function () {
                var map = {};
                $(this).find("input, textarea, select").each(function () {
                    var tag = $(this).prop("tagName");
                    var name = $(this).attr('name');
                    var type = $(this).attr('type');
                    var value = $(this).val();
                    if (typeof (name) !== 'undefined') {
                        if ((type === 'radio' || type === 'checkbox') && tag === 'INPUT') {
                            if ($(this).is(':checked')) {
                                map[name] = value;
                            }
                        } else {
                            map[name] = value;
                        }
                    }
                });
                map['background-type'] = $(this)
                    .find('div.toggle-background')
                    .find('button.btn-success')
                    .val();
                map['l-position'] = $(this).find('.left.position-item.active').data('value');
                map['r-position'] = $(this).find('.right.position-item.active').data('value')
                list.push(map);
            });
            var json = JSON.stringify(list);
            $('#slides').val(json);
            console.log(json);
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