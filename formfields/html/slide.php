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
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/scripts.js');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/admin.css');
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
<div class="zt-slide">
    <div class="container-fluid">
        <!-- Wrapper -->
        <div class="span12 slides sortable">
            <!-- An slide -->
            <div class="row slide">
                <div class="span12">
                    <div class="row">
                        <!-- Left -->
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
                        <!-- Right -->                        
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

                        <div class="zt-slider">
                            <!-- Wrapper -->
                            <div class="slides sortable">
                                <!-- An slide -->
                                <div class="slider-items slide">
                                    <h3 class="slider-title">Slider Element</h3>
                                    <div class="row-fluid slider-general">
                                        <div class="span4">
                                            <div class="slider-element slider-text">
                                                <label>Background color</label>
                                                <input name="background-color" class="span12" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="slider-element slider-text">
                                                <label>Background image</label>
                                                <input name="background-image" class="span12" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="slider-element slider-text">
                                                <label>Background video</label>
                                                <input name="background-video" class="span12" placeholder="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Position Left -->
                                        <div class="span6">
                                            <div class="position-left">
                                                <div class="slider-element slide-image">
                                                    <label>Image</label>
                                                    <input name="l-image" class="span12" placeholder="Choose Image" type="text">
                                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                                                </div>
                                                <div class="slider-element slide-embed">
                                                    <label>Embed code</label>
                                                    <input name="l-embed" class="span12" placeholder="Fill code embed" type="text">
                                                </div>
                                                <!-- Add more option fields here -->
                                                <div class="slider-element slider-select">
                                                    <label>Type</label>
                                                    <select name="l-type" class="span12">
                                                        <option selected value="image">Image</option>
                                                        <option value="embed">Embed video</option>
                                                    </select>
                                                </div>
                                                <div class="slider-element slider-select">
                                                    <label>Effect</label>
                                                    <select name="l-effect" class="span12">
                                                        <option selected value="image">Image</option>
                                                        <option value="embed">Embed video</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Position Right -->
                                        <div class="span6">
                                            <div class="position-right">
                                                <div class="slider-element slide-image">
                                                    <label>Image</label>
                                                    <input name="r-image" class="span12" placeholder="Choose Image" type="text">
                                                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                                                </div>
                                                <div class="slider-element slide-embed">
                                                    <label>Embed code</label>
                                                    <input name="r-embed" class="span12" placeholder="Fill code embed" type="text">
                                                </div>
                                                <!-- Add more option fields here -->
                                                <div class="slider-element slider-select">
                                                    <label>Type</label>
                                                    <select name="r-type" class="span12">
                                                        <option selected value="image">Image</option>
                                                        <option value="embed">Embed video</option>
                                                    </select>
                                                </div>
                                                <div class="slider-element slider-select">
                                                    <label>Effect</label>
                                                    <select name="r-effect" class="span12">
                                                        <option selected value="image">Image</option>
                                                        <option value="embed">Embed video</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-slider btn btn-primary" onclick="zo2.modules.slideshow.addSlide(this);">Add slide</button>
                            </div>
                            <input id="slides" type="hidden" name="jform[params][slides]" value=""/>
                        </div>