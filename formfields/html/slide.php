<?php
$link = 'index.php?option=com_media&amp;view=images&amp;tmpl=component';
$button = new JObject;
$button->modal = true;
$button->class = 'btn modal';
$button->link = $link;
$button->text = JText::_('PLG_IMAGE_BUTTON_IMAGE');
$button->name = 'picture';
$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
?>
<script>
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
            <div class="row slide" id="zt-slideshow-container">
                <div class="span12" id="zt-slideshow-element">
                    <label>Title</label>
                    <input name="title" class="span12" placeholder="Enter slide title" type="text">

                    <label>Description</label>                    
                    <input name="description" class="span12" placeholder="Enter slide description" type="text">

                    <div class="slide-image">                       
                        <label>Image</label>
                        <input name="image" id="zt-slideshow-image" class="span12" placeholder="Your email address" type="text">
                        <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>                         
                    </div>
                    <div class="slide-embed">
                        <label>Embed code</label>
                        <input name="embed" class="span12" placeholder="Your email address" type="text">
                    </div>
                    <!-- Add more option fields here -->
                    <label>Subject</label>
                    <select name="type" class="span12">
                        <option selected value="image">Image</option>
                        <option value="embed">Embed video</option>                        
                    </select>                    
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="zo2.modules.slideshow.addSlide();">Add slide</button>
        </div>
    </div>
    <input id="slides" type="hidden" name="jform[params][slides]" value="" />
</div>