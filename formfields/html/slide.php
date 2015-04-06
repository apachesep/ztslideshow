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
                this.hookSave();
            },
            addSlide: function (el) {
                var $parentEl = jQuery(el).parent();
                jQuery($parentEl[0]).clone().insertAfter('.zt-slide .slides .slide');
            },
            hookSave: function () {
                jQuery('#toolbar-apply button').on('click', function () {
                    zo2.modules.slideshow.generateSlidesJSON();
                    return false;
                    //Joomla.submitbutton('module.apply');
                })
            },
            generateSlidesJSON: function () {
                var $slides = jQuery('.slides .slide');
                var list = [];
                jQuery($slides).each(function () {
                    var slide = [];
                    slide['title'] = jQuery(this).find('[name="title"]').val();
                    list.push(slide);
                });
                var json = JSON.stringify(list);
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
                                    <input name="limage" class="span12" placeholder="Your email address" type="text">
                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>                         
                                </div>
                                <div class="slide-embed">
                                    <label>Embed code</label>
                                    <input name="lembed" class="span12" placeholder="Your email address" type="text">
                                </div>
                                <!-- Add more option fields here -->
                                <label>Type</label>
                                <select name="ltype" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select>          
                                <label>Effect</label>
                                <select name="leffect" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select> 
                            </div>
                        </div>
                        <div class="span6">
                            <div class="position-right">
                                <div class="slide-image">                       
                                    <label>Image</label>
                                    <input name="rimage" class="span12" placeholder="Your email address" type="text">
                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>                         
                                </div>
                                <div class="slide-embed">
                                    <label>Embed code</label>
                                    <input name="rembed" class="span12" placeholder="Your email address" type="text">
                                </div>
                                <!-- Add more option fields here -->
                                <label>Type</label>
                                <select name="rtype" class="span12">
                                    <option selected value="image">Image</option>
                                    <option value="embed">Embed video</option>                        
                                </select>    
                                <label>Effect</label>
                                <select name="reffect" class="span12">
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