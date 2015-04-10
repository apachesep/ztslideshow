<?php

/* {$id} */

$slides = json_decode($this->value);

$link = 'index.php?option=com_media&amp;view=images&amp;tmpl=component';
$button = new JObject;
$button->modal = true;
$button->class = 'btn modal';
$button->link = $link;
$button->text = JText::_('Select image');
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
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/scripts.js');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/back/admin.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/fontawesome/css/font-awesome.min.css');
?>
<script>
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


<div class="zt-slider" id="zt-slidershow-wrapper">
    <!-- Wrapper -->
    <div class="slides sortable" id="zt-slidershow-container">
        <?php if (count($slides) > 0): ?>
            <?php foreach ($slides as $slide) : ?>
                <?php $slide = new JObject($slide); ?>
                <?php require __DIR__ . '/slide.php'; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?php $slide = new JObject (); ?>            
            <?php require __DIR__ . '/slide.php'; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="btn-add-slider btn btn-primary" onclick="zo2.modules.slideshow.addSlide(this);">Add
        slide
    </button>

    <input id="slides" type="hidden" name="jform[params][slides]" value=""/>
</div>