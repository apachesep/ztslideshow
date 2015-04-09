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
<?php
require_once dirname(__FILE__) . '/../../helper/helper.php';
$valueBackgroundType = $slide->get('background-type', 'color');
$lPosition = $slide->get('l-position', '');
$rPosition = $slide->get('r-position', '');
$lColumn = $slide->get('l-column', '');
$rColumn = $slide->get('r-column', '');
?>
<!-- An slide -->
<div class="slider-items slide">
    <h3 class="slider-title">Slider Element</h3>
    <!-- Background -->
    <div class="slider-toggle">
        <div class="toggle-background clearfix">
            <label class="radio pull-left">
                <input onchange="zo2.modules.slideshow.backgroundToggle(this);" type="radio" name="background-type" id="background-image" data-toggle="toggle-image" value="image" <?php echo ($valueBackgroundType == 'image') ? 'checked="checked"' : ''; ?>>
                Background Image
            </label>
            <label class="radio pull-left">
                <input onchange="zo2.modules.slideshow.backgroundToggle(this);" type="radio" name="background-type" id="background-color" data-toggle="toggle-color" value="color" <?php echo ($valueBackgroundType == 'color') ? 'checked="checked"' : ''; ?>>
                Background Color
            </label>
            <label class="radio pull-left">
                <input onchange="zo2.modules.slideshow.backgroundToggle(this);" type="radio" name="background-type" id="background-video" data-toggle="toggle-video" value="video" <?php echo ($valueBackgroundType == 'video') ? 'checked="checked"' : ''; ?>>
                Background Video
            </label>
        </div>
        <div class="toggle-background-setting clearfix">
            <div class="slider-element slider-text" id="toggle-color">
                <label>Background color</label>
                <input name="background-color" class="span12" placeholder="Enter your background color code" type="text"
                       value="<?php echo $slide->get('background-color'); ?>">
            </div>
            <div class="slider-element slider-text" id="toggle-image">
                <label>Background image</label>
                <input name="background-image" class="span12" placeholder="Enter your background image relative path"
                       type="text" value="<?php echo $slide->get('background-image'); ?>">
            </div>
            <div class="slider-element slider-text" id="toggle-video">
                <label>Background video</label>
                <input name="background-video" class="span12" placeholder="Enter your background video relative path"
                       type="text" value="<?php echo $slide->get('background-video'); ?>">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <!-- Position Left -->
        <div class="span6">
            <div class="position-left element-position">
                <h3>Position Left</h3>
                <!-- Type -->
                <div class="slider-element slider-select">
                    <label>Type</label>
                    <select onchange="zo2.modules.slideshow.typeToggle(this);" name="l-type" class="span12">
                        <option <?php echo ($slide->get('l-type') == 'image') ? 'selected' : ''; ?> value="image">Image</option>
                        <option <?php echo ($slide->get('l-type') == 'embed') ? 'selected' : ''; ?> value="embed">Embed video</option>
                        <option <?php echo ($slide->get('l-type') == 'text') ? 'selected' : ''; ?> value="text">Text</option>
                    </select>
                </div>
                <div class="slider-element element-toggle slide-image">
                    <label>Image</label>
                    <input name="l-image" class="span12" placeholder="Choose Image" type="text"
                           value="<?php echo $slide->get('l-image'); ?>">
                           <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                </div>
                <div class="slider-element element-toggle slide-embed" style="display: none">
                    <label>Embed code</label>
                    <input name="l-embed" class="span12" placeholder="Fill code embed" type="text"
                           value="<?php echo $slide->get('l-embed'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Title</label>
                    <input name="l-text-title" class="span12" placeholder="Fill Title" type="text"
                           value="<?php echo $slide->get('l-text-title'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Small Title</label>
                    <input name="l-text-stitle" class="span12" placeholder="Fill Small Title" type="text"
                           value="<?php echo $slide->get('l-text-stitle'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Content</label>
                    <textarea name="l-text-des" class="span12" placeholder="Fill Content"><?php echo $slide->get('l-text-des'); ?></textarea>
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Link</label>
                    <textarea name="l-text-link" class="span12" placeholder="Fill Text Link"><?php echo $slide->get('l-text-link'); ?></textarea>
                </div>

                <div class="slider-element slider-position clearfix">
                    <label>Position</label>
                    <ul>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'top-left') ? 'active' : ''; ?> position-item" id="ps-top-left" data-value="top-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'top-center') ? 'active' : ''; ?> position-item" id="ps-top-center" data-value="top-center"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'top-right') ? 'active' : ''; ?> position-item" id="ps-top-right" data-value="top-right"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'center-left') ? 'active' : ''; ?> position-item" id="ps-center-left" data-value="center-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'center-middle') ? 'active' : ''; ?> position-item" id="ps-center-middle" data-value="center-middle"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'center-right') ? 'active' : ''; ?> position-item" id="ps-center-right" data-value="center-right"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'bottom-left') ? 'active' : ''; ?> position-item" id="ps-bottom-left" data-value="bottom-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'bottom-center') ? 'active' : ''; ?> position-item" id="ps-bottom-center" data-value="bottom-center"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="left <?php echo ($lPosition == 'bottom-right') ? 'active' : ''; ?> position-item" id="ps-bottom-right" data-value="bottom-right"></li>
                    </ul>
                </div>
                <div class="slider-element slider-column">
                    <label>Effect</label>
                    <select name="l-column" class="span12 select-column">
                        <option value="1" <?php echo ($lColumn == 1 ) ? 'selected' : ''; ?> >1</option>
                        <option value="2" <?php echo ($lColumn == 2 ) ? 'selected' : ''; ?> >2</option>
                        <option value="3" <?php echo ($lColumn == 3 ) ? 'selected' : ''; ?> >3</option>
                        <option value="4" <?php echo ($lColumn == 4 ) ? 'selected' : ''; ?> >4</option>
                        <option value="5" <?php echo ($lColumn == 5 ) ? 'selected' : ''; ?> >5</option>
                        <option value="6" <?php echo ($lColumn == 6 ) ? 'selected' : ''; ?> >6</option>
                        <option value="7" <?php echo ($lColumn == 7 ) ? 'selected' : ''; ?> >7</option>
                        <option value="8" <?php echo ($lColumn == 8 ) ? 'selected' : ''; ?> >8</option>
                        <option value="9" <?php echo ($lColumn == 9 ) ? 'selected' : ''; ?> >9</option>
                        <option value="10" <?php echo ($lColumn == 10 ) ? 'selected' : ''; ?> >10</option>
                        <option value="11" <?php echo ($lColumn == 11 ) ? 'selected' : ''; ?> >11</option>
                        <option value="12" <?php echo ($lColumn == 12 ) ? 'selected' : ''; ?> >12</option>
                    </select>
                </div>
                <div class="slider-element slider-text">
                    <label>Effect</label>
                    <select name="l-effect" class="span12">
                        <?php echo ZtSlideshowHelperHelper::effectSlider(); ?>
                    </select>
                </div>

            </div>
        </div>

        <!-- Position Right -->
        <div class="span6">
            <div class="position-right element-position">
                <h3>Position Right</h3>
                <!-- Add more option fields here -->
                <div class="slider-element slider-select">
                    <label>Type</label>
                    <select onchange="zo2.modules.slideshow.typeToggle(this);" name="r-type" class="span12 select-type">
                        <option <?php echo ($slide->get('l-type') == 'image') ? 'selected' : ''; ?> value="image">Image</option>
                        <option <?php echo ($slide->get('l-type') == 'embed') ? 'selected' : ''; ?> value="embed">Embed video</option>
                        <option <?php echo ($slide->get('l-type') == 'text') ? 'selected' : ''; ?> value="text">Text</option>
                    </select>
                </div>
                <div class="slider-element element-toggle slide-image">
                    <label>Image</label>
                    <input name="r-image" class="span12" placeholder="Choose Image" type="text"
                           value="<?php echo $slide->get('r-image'); ?>">
                           <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                </div>
                <div class="slider-element element-toggle slide-embed" style="display: none">
                    <label>Embed code</label>
                    <input name="r-embed" class="span12" placeholder="Fill code embed" type="text"
                           value="<?php echo $slide->get('r-embed'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Title</label>
                    <input name="r-text-title" class="span12" placeholder="Fill Title" type="text"
                           value="<?php echo $slide->get('r-text-title'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Small Title</label>
                    <input name="r-text-stitle" class="span12" placeholder="Fill Small Title" type="text"
                           value="<?php echo $slide->get('r-text-stitle'); ?>">
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Content</label>
                    <textarea name="r-text-des" class="span12" placeholder="Fill Content"><?php echo $slide->get('r-text-des'); ?></textarea>
                </div>
                <div class="slider-element element-toggle slide-text" style="display: none">
                    <label>Link</label>
                    <textarea name="r-text-link" class="span12" placeholder="Fill Text Link"><?php echo $slide->get('r-text-link'); ?></textarea>
                </div>
                <div class="slider-element slider-position clearfix">
                    <label>Position</label>
                    <ul>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'top-left') ? 'active' : ''; ?> position-item" id="ps-top-left" data-value="top-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'top-center') ? 'active' : ''; ?> position-item" id="ps-top-center" data-value="top-center"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'top-right') ? 'active' : ''; ?> position-item" id="ps-top-right" data-value="top-right"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'center-left') ? 'active' : ''; ?> position-item" id="ps-center-left" data-value="center-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'center-middle') ? 'active' : ''; ?> position-item" id="ps-center-middle" data-value="center-middle"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'center-right') ? 'active' : ''; ?> position-item" id="ps-center-right" data-value="center-right"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'bottom-left') ? 'active' : ''; ?> position-item" id="ps-bottom-left" data-value="bottom-left"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'bottom-center') ? 'active' : ''; ?> position-item" id="ps-bottom-center" data-value="bottom-center"></li>
                        <li onClick="zo2.modules.slideshow.selectPosition(this);" class="right <?php echo ($rPosition == 'bottom-right') ? 'active' : ''; ?> position-item" id="ps-bottom-right" data-value="bottom-right"></li>
                    </ul>
                </div>
                <div class="slider-element slider-column">
                    <label>Effect</label>
                    <select name="r-column" class="span12 select-column">
                        <option value="1" <?php echo ($rColumn == 1 ) ? 'selected' : ''; ?> >1</option>
                        <option value="2" <?php echo ($rColumn == 2 ) ? 'selected' : ''; ?> >2</option>
                        <option value="3" <?php echo ($rColumn == 3 ) ? 'selected' : ''; ?> >3</option>
                        <option value="4" <?php echo ($rColumn == 4 ) ? 'selected' : ''; ?> >4</option>
                        <option value="5" <?php echo ($rColumn == 5 ) ? 'selected' : ''; ?> >5</option>
                        <option value="6" <?php echo ($rColumn == 6 ) ? 'selected' : ''; ?> >6</option>
                        <option value="7" <?php echo ($rColumn == 7 ) ? 'selected' : ''; ?> >7</option>
                        <option value="8" <?php echo ($rColumn == 8 ) ? 'selected' : ''; ?> >8</option>
                        <option value="9" <?php echo ($rColumn == 9 ) ? 'selected' : ''; ?> >9</option>
                        <option value="10" <?php echo ($rColumn == 10 ) ? 'selected' : ''; ?> >10</option>
                        <option value="11" <?php echo ($rColumn == 11 ) ? 'selected' : ''; ?> >11</option>
                        <option value="12" <?php echo ($rColumnColumn == 12 ) ? 'selected' : ''; ?> >12</option>
                    </select>
                </div>
                <div class="slider-element slider-text">
                    <label>Effect</label>
                    <select name="r-effect" class="span12">
                        <?php echo ZtSlideshowHelperHelper::effectSlider(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
