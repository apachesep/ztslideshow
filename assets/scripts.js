 function setActive(el) {
        jQuery(el).toggleClass('select-image-focused');
    }
    ;

    jQuery(function () {
        jQuery(".sortable").sortable();
        jQuery(".sortable").disableSelection();
    });
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
                //  this.hookSave();
            },
            addSlide: function (el) {
                var $parentEl = jQuery(el).prev();
                console.log ($parentEl);
                jQuery($parentEl[0]).clone().insertAfter('.zt-slider .slides .slide');
                jQuery(".sortable").sortable();
            },
            hookSave: function () {
                zo2.modules.slideshow.generateSlidesJSON();

            },
            generateSlidesJSON: function () {
                var $slides = jQuery('.slides .slide');
                var list = [];
                jQuery($slides).each(function () {
                    var map = {};
                    jQuery(this).find("input").each(function () {
                        map[jQuery(this).attr("name")] = jQuery(this).val();
                    });
                    jQuery(this).find("select").each(function () {
                        map[jQuery(this).attr("name")] = jQuery(this).val();
                    });
                    list.push(map);
                });
                console.log(list);
                var json = JSON.stringify(list);
                console.log(json);
                jQuery('#slides').val(json);
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
    /**
     * Default function. Usually would be overriden by the component
     */
    Joomla.submitbutton = function (pressbutton) {
        zo2.modules.slideshow.hookSave();
        if (pressbutton) {
            document.adminForm.task.value = pressbutton;
        }
        if (typeof document.adminForm.onsubmit == "function") {
            document.adminForm.onsubmit();
        }
        if (typeof document.adminForm.fireEvent == "function") {
            document.adminForm.fireEvent('onsubmit');
        }
        document.adminForm.submit();
    }