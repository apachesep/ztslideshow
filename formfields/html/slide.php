<?php
$link = 'index.php?option=com_media&amp;view=images&amp;tmpl=component';
$button = new JObject;
$button->modal = true;
$button->class = 'btn modal';
$button->link = $link;
$button->text = JText::_('PLG_IMAGE_BUTTON_IMAGE');
$button->name = 'picture';
$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
$button->onclick = 'setActive(this);';
$script = "
			if (typeof jInsertEditorText == 'undefined'){
				function jInsertEditorText(text, editor) {
					var source = text.match(/(src)=(\"[^\"]*\")/i), img;
					text = source[2].replace(/\\\"/g, '');
					img =  text;

					
                                        // Current focused
                                        input = jQuery('.select-image-focused').prev();
                                        jQuery(input).val(img);
                                        jQuery('.select-image-focused').removeClass('select-image-focused');
				};
			};
			";
$doc = JFactory::getDocument();
$doc->addScriptDeclaration($script);
?>

<script>
    function setActive(el) {
        jQuery(el).toggleClass('select-image-focused');
    }
    ;
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
                var $parentEl = jQuery(el).parent();
                jQuery($parentEl[0]).clone().insertAfter('.zt-slide .slides .slide');
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
</script>
<div class="zt-slide">
    <div class="container-fluid">
        <div class="span12 slides">
            <div class="row slide">
                <div class="span12">
                    <div class="row">
                        <div class="span6">
                            <div class="position-left">
                                <div class="slide-image">                       
                                    <label>Image</label>
                                    <input name="l-image" class="span12" placeholder="Your email address" type="text">
                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>                         
                                </div>
                                <div class="slide-embed">
                                    <label>Embed code</label>
                                    <input name="l-embed" class="span12" placeholder="Your email address" type="text">
                                </div>
                                <!-- Add more option fields here -->
                                <label>Type</label>
                                <select name="l-type" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select>          
                                <label>Effect</label>
                                <select name="l-effect" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select> 
                            </div>
                        </div>
                        <div class="span6">
                            <div class="position-right">
                                <div class="slide-image">                       
                                    <label>Image</label>
                                    <input name="r-image" class="span12" placeholder="Your email address" type="text">
                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>                         
                                </div>
                                <div class="slide-embed">
                                    <label>Embed code</label>
                                    <input name="r-embed" class="span12" placeholder="Your email address" type="text">
                                </div>
                                <!-- Add more option fields here -->
                                <label>Type</label>
                                <select name="r-type" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select>    
                                <label>Effect</label>
                                <select name="r-effect" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <button type="button" class="btn btn-primary" onclick="zo2.modules.slideshow.addSlide(this);">Add slide</button>
            </div>
        </div>
    </div>
    <input id="slides" type="hidden" name="jform[params][slides]" value="" />
</div>