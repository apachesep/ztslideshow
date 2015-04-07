<?php
/**
 * ZT Slideshow
 * 
 * @package     Joomla
 * @subpackage  Module
 * @version     1.0.0
 * @author      ZooTemplate 
 * @email       support@zootemplate.com 
 * @link        http://www.zootemplate.com 
 * @copyright   Copyright (c) 2015 ZooTemplate
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted access');
?>
<!-- An slide -->
<div class="slider-items slide">    
    <button type="button" class="btn-add-slider btn btn-primary" onclick="zo2.modules.slideshow.removeSlide(this);">Remove</button>
    <h3 class="slider-title">
        Slider Element        
    </h3>    
    <div class="row-fluid slider-general">
        <div class="span4">
            <div class="slider-element slider-text">
                <label>Background color</label>
                <input name="background-color" class="span12" placeholder="Enter your background color code" type="text" value="<?php echo $slide->get('background-color'); ?>">
            </div>
        </div>
        <div class="span4">
            <div class="slider-element slider-text">
                <label>Background image</label>
                <input name="background-image" class="span12" placeholder="Enter your background image relative path" type="text" value="<?php echo $slide->get('background-image'); ?>">
            </div>
        </div>
        <div class="span4">
            <div class="slider-element slider-text">
                <label>Background video</label>
                <input name="background-video" class="span12" placeholder="Enter your background video relative path" type="text" value="<?php echo $slide->get('background-video'); ?>">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <!-- Position Left -->
        <div class="span6">
            <div class="position-left">
                <div class="slider-element slide-image">
                    <label>Image</label>
                    <input name="l-image" class="span12" placeholder="Choose Image" type="text" value="<?php echo $slide->get('l-image'); ?>">
                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                </div>
                <div class="slider-element slide-embed">
                    <label>Embed code</label>
                    <input name="l-embed" class="span12" placeholder="Fill code embed" type="text" value="<?php echo $slide->get('l-embed'); ?>">
                </div>
                <!-- Add more option fields here -->
                <div class="slider-element slider-select">
                    <label>Type</label>
                    <select name="l-type" class="span12">
                        <option <?php echo ($slide->get('l-type') == 'image') ? 'selected' : ''; ?> value="image">Image</option>
                        <option <?php echo ($slide->get('l-type') == 'embed') ? 'selected' : ''; ?> value="embed">Embed video</option>
                    </select>
                </div>
                <div class="slider-element slider-select">
                    <label>Effect</label>
                    <select name="l-effect" class="span12">                             
                    </select>
                </div>

            </div>
        </div>

        <!-- Position Right -->
        <div class="span6">
            <div class="position-right">
                <div class="slider-element slide-image">
                    <label>Image</label>
                    <input name="r-image" class="span12" placeholder="Choose Image" type="text" value="<?php echo $slide->get('r-image'); ?>" >
                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                </div>
                <div class="slider-element slide-embed">
                    <label>Embed code</label>
                    <input name="r-embed" class="span12" placeholder="Fill code embed" type="text" value="<?php echo $slide->get('r-embed'); ?>">
                </div>
                <!-- Add more option fields here -->
                <div class="slider-element slider-select">
                    <label>Type</label>
                    <select name="r-type" class="span12">
                        <option <?php echo ($slide->get('r-type') == 'image') ? 'selected' : ''; ?> value="image">Image</option>
                        <option <?php echo ($slide->get('r-type') == 'embed') ? 'selected' : ''; ?> value="embed">Embed video</option>
                    </select>
                </div>
                <div class="slider-element slider-select">
                    <label>Effect</label>
                    <select name="r-effect" class="span12">                             
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>