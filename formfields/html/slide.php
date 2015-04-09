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
?>
<!-- An slide -->
<div class="slider-items slide">
    <h3 class="slider-title">Slider Element</h3>
    <span class="pull-right slider-accordion"><i onclick="zo2.modules.slideshow.sliderAccordion(this)" class="fa fa-plus"></i><i
            class="fa fa-arrows-alt"></i></span>
    <!-- Background -->
    <div class="slider-content">
        <div class="slider-toggle">
            <h3 class="pull-left">Background</h3>

            <div class="toggle-background clearfix">
                <select onchange="zo2.modules.slideshow.backgroundToggle(this);" name="background-type" class="span12"
                        tabindex="6">
                    <option <?php echo ($slide->get('background-type') == 'image') ? 'selected="selected"' : ''; ?>
                        value="image" data-value="toggle-image">Image
                    </option>
                    <option <?php echo ($slide->get('background-type') == 'video') ? 'selected="selected"' : ''; ?>
                        value="video" data-value="toggle-video">Video
                    </option>
                    <option <?php echo ($slide->get('background-type') == 'color') ? 'selected="selected"' : ''; ?>
                        value="color" data-value="toggle-color">Color
                    </option>
                </select>
            </div>
            <div class="toggle-background-setting clearfix">
                <div class="slider-element slider-text"
                     id="toggle-color" <?php echo ($slide->get('background-type') == 'color') ? 'style="display:block"' : ''; ?>>
                    <label>Background color</label>
                    <input name="background-color" class="span12" placeholder="Enter your background color code"
                           type="text"
                           value="<?php echo $slide->get('background-color'); ?>">
                </div>
                <div class="slider-element slider-text slide-image"
                     id="toggle-image" <?php echo ($slide->get('background-type') == 'image') ? 'style="display:block"' : ''; ?>>
                    <label>Background image</label>
                    <input name="background-image" class="span12"
                           placeholder="Enter your background image relative path"
                           type="text" value="<?php echo $slide->get('background-image'); ?>">
                    <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                </div>
                <div class="slider-element slider-text"
                     id="toggle-video" <?php echo ($slide->get('background-type') == 'video') ? 'style="display:block"' : ''; ?>>
                    <label>Background video</label>
                    <input name="background-video" class="span12"
                           placeholder="Enter your background video relative path"
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
                        <select onchange="zo2.modules.slideshow.typeToggle(this);" name="l-type" class="span12"
                                tabindex="6">
                            <option <?php echo ($slide->get('l-type') == 'image') ? 'selected="selected"' : ''; ?>
                                value="image">Image
                            </option>
                            <option <?php echo ($slide->get('l-type') == 'embed') ? 'selected="selected"' : ''; ?>
                                value="embed">Embed video
                            </option>
                            <option <?php echo ($slide->get('l-type') == 'text') ? 'selected="selected"' : ''; ?>
                                value="text">Text
                            </option>
                        </select>
                    </div>
                    <div
                        class="slider-element element-toggle slide-image" <?php echo ($slide->get('l-type') == 'image') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Image</label>
                        <input name="l-image" class="span12" placeholder="Choose Image" type="text"
                               value="<?php echo $slide->get('l-image'); ?>">
                        <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                    </div>
                    <div
                        class="slider-element element-toggle slide-embed" <?php echo ($slide->get('l-type') == 'embed') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Embed code</label>
                        <textarea name="l-embed" class="span12" placeholder="Fill code embed"
                                  type="text"><?php echo $slide->get('l-embed'); ?></textarea>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('l-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Title</label>
                        <input name="l-text-title" class="span12" placeholder="Fill Title" type="text"
                               value="<?php echo $slide->get('l-text-title'); ?>">
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('l-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Small Title</label>
                        <input name="l-text-stitle" class="span12" placeholder="Fill Small Title" type="text"
                               value="<?php echo $slide->get('l-text-stitle'); ?>">
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('l-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Content</label>
                        <textarea name="l-text-des" class="span12"
                                  placeholder="Fill Content"><?php echo $slide->get('l-text-des'); ?></textarea>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('l-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Text Link</label>
                        <input name="l-text-link" class="span12" placeholder="Fill Text Link"
                               value="<?php echo $slide->get('l-text-link'); ?>"/>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('l-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Link</label>
                        <input name="l-link" class="span12" placeholder="Fill Link"
                               value="<?php echo $slide->get('l-link'); ?>"/>
                    </div>

                    <div class="slider-element slider-position clearfix">
                        <label>Position</label>
                        <ul>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'top-left') ? 'active' : ''; ?> position-item"
                                id="ps-top-left" data-value="top-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'top-center') ? 'active' : ''; ?> position-item"
                                id="ps-top-center" data-value="top-center"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'top-right') ? 'active' : ''; ?> position-item"
                                id="ps-top-right" data-value="top-right"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'center-left') ? 'active' : ''; ?> position-item"
                                id="ps-center-left" data-value="center-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'center-middle') ? 'active' : ''; ?> position-item"
                                id="ps-center-middle" data-value="center-middle"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'center-right') ? 'active' : ''; ?> position-item"
                                id="ps-center-right" data-value="center-right"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'bottom-left') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-left" data-value="bottom-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'bottom-center') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-center" data-value="bottom-center"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="left <?php echo ($lPosition == 'bottom-right') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-right" data-value="bottom-right"></li>
                        </ul>
                    </div>
                    <div class="slider-element slider-column">
                        <label>Width</label>
                        <select name="l-column" class="span12 select-column">
                            <option <?php echo ($slide->get('l-column') == 'none') ? 'selected="selected"' : ''; ?>
                                value="none">none
                            </option>
                            <option <?php echo ($slide->get('l-column') == '1') ? 'selected="selected"' : ''; ?>
                                value="1">1
                            </option>
                            <option <?php echo ($slide->get('l-column') == '2') ? 'selected="selected"' : ''; ?>
                                value="2">2
                            </option>
                            <option <?php echo ($slide->get('l-column') == '3') ? 'selected="selected"' : ''; ?>
                                value="3">3
                            </option>
                            <option <?php echo ($slide->get('l-column') == '4') ? 'selected="selected"' : ''; ?>
                                value="4">4
                            </option>
                            <option <?php echo ($slide->get('l-column') == '5') ? 'selected="selected"' : ''; ?>
                                value="5">5
                            </option>
                            <option <?php echo ($slide->get('l-column') == '6') ? 'selected="selected"' : ''; ?>
                                value="6">6
                            </option>
                            <option <?php echo ($slide->get('l-column') == '7') ? 'selected="selected"' : ''; ?>
                                value="7">7
                            </option>
                            <option <?php echo ($slide->get('l-column') == '8') ? 'selected="selected"' : ''; ?>
                                value="8">8
                            </option>
                            <option <?php echo ($slide->get('l-column') == '9') ? 'selected="selected"' : ''; ?>
                                value="9">9
                            </option>
                            <option <?php echo ($slide->get('l-column') == '10') ? 'selected="selected"' : ''; ?>
                                value="10">10
                            </option>
                            <option <?php echo ($slide->get('l-column') == '11') ? 'selected="selected"' : ''; ?>
                                value="11">11
                            </option>
                            <option <?php echo ($slide->get('l-column') == '12') ? 'selected="selected"' : ''; ?>
                                value="12">12
                            </option>
                        </select>
                    </div>
                    <div class="slider-element slider-text">
                        <label>Effect</label>
                        <?php $l_effect = $slide->get('l-effect'); ?>
                        <select name="l-effect" class="span12">
                            <?php echo ZtSlideshowHelperHelper::effectSlider($l_effect); ?>
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
                        <select onchange="zo2.modules.slideshow.typeToggle(this);" name="r-type"
                                class="span12 select-type">
                            <option <?php echo ($slide->get('r-type') == 'image') ? 'selected="selected"' : ''; ?>
                                value="image">Image
                            </option>
                            <option <?php echo ($slide->get('r-type') == 'embed') ? 'selected="selected"' : ''; ?>
                                value="embed">Embed video
                            </option>
                            <option <?php echo ($slide->get('r-type') == 'text') ? 'selected="selected"' : ''; ?>
                                value="text">Text
                            </option>
                        </select>
                    </div>
                    <div
                        class="slider-element element-toggle slide-image" <?php echo ($slide->get('r-type') == 'image') ? 'style="display:block"' : 'style="display:none"'; ?>>
                        <label>Image</label>
                        <input name="r-image" class="span12" placeholder="Choose Image" type="text"
                               value="<?php echo $slide->get('r-image'); ?>">
                        <?php echo JLayoutHelper::render('joomla.editors.buttons.button', $button); ?>
                    </div>
                    <div
                        class="slider-element element-toggle slide-embed" <?php echo ($slide->get('r-type') == 'embed') ? 'style="display:block"' : 'style="display:none"'; ?>>
                        <label>Embed code</label>
                        <textarea name="r-embed" class="span12" placeholder="Fill code embed"
                                  type="text"><?php echo $slide->get('r-embed'); ?></textarea>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('r-type') == 'text') ? 'style="display:block"' : 'style="display:none"'; ?>>
                        <label>Title</label>
                        <input name="r-text-title" class="span12" placeholder="Fill Title" type="text"
                               value="<?php echo $slide->get('r-text-title'); ?>">
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('r-type') == 'text') ? 'style="display:block"' : 'style="display:none"'; ?>>
                        <label>Small Title</label>
                        <input name="r-text-stitle" class="span12" placeholder="Fill Small Title" type="text"
                               value="<?php echo $slide->get('r-text-stitle'); ?>">
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('r-type') == 'text') ? 'style="display:block"' : 'style="display:none"'; ?>>
                        <label>Content</label>
                        <textarea name="r-text-des" class="span12"
                                  placeholder="Fill Content"><?php echo $slide->get('r-text-des'); ?></textarea>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('r-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Text Link</label>
                        <input name="r-text-link" class="span12" placeholder="Fill Text Link"
                               value="<?php echo $slide->get('r-text-link'); ?>"/>
                    </div>
                    <div
                        class="slider-element element-toggle slide-text" <?php echo ($slide->get('r-type') == 'text') ? 'style="display:block"' : 'style="display: none"'; ?>>
                        <label>Link</label>
                        <input name="r-link" class="span12" placeholder="Fill Link"
                               value="<?php echo $slide->get('r-link'); ?>"/>
                    </div>
                    <div class="slider-element slider-position clearfix">
                        <label>Position</label>
                        <ul>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'top-left') ? 'active' : ''; ?> position-item"
                                id="ps-top-left" data-value="top-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'top-center') ? 'active' : ''; ?> position-item"
                                id="ps-top-center" data-value="top-center"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'top-right') ? 'active' : ''; ?> position-item"
                                id="ps-top-right" data-value="top-right"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'center-left') ? 'active' : ''; ?> position-item"
                                id="ps-center-left" data-value="center-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'center-middle') ? 'active' : ''; ?> position-item"
                                id="ps-center-middle" data-value="center-middle"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'center-right') ? 'active' : ''; ?> position-item"
                                id="ps-center-right" data-value="center-right"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'bottom-left') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-left" data-value="bottom-left"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'bottom-center') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-center" data-value="bottom-center"></li>
                            <li onClick="zo2.modules.slideshow.selectPosition(this);"
                                class="right <?php echo ($rPosition == 'bottom-right') ? 'active' : ''; ?> position-item"
                                id="ps-bottom-right" data-value="bottom-right"></li>
                        </ul>
                    </div>
                    <div class="slider-element slider-column">
                        <label>Width</label>
                        <select name="r-column" class="span12 select-column">
                            <option <?php echo ($slide->get('r-column') == 'none') ? 'selected="selected"' : ''; ?>
                                value="none">none
                            </option>
                            <option <?php echo ($slide->get('r-column') == '1') ? 'selected="selected"' : ''; ?>
                                value="1">1
                            </option>
                            <option <?php echo ($slide->get('r-column') == '2') ? 'selected="selected"' : ''; ?>
                                value="2">2
                            </option>
                            <option <?php echo ($slide->get('r-column') == '3') ? 'selected="selected"' : ''; ?>
                                value="3">3
                            </option>
                            <option <?php echo ($slide->get('r-column') == '4') ? 'selected="selected"' : ''; ?>
                                value="4">4
                            </option>
                            <option <?php echo ($slide->get('r-column') == '5') ? 'selected="selected"' : ''; ?>
                                value="5">5
                            </option>
                            <option <?php echo ($slide->get('r-column') == '6') ? 'selected="selected"' : ''; ?>
                                value="6">6
                            </option>
                            <option <?php echo ($slide->get('r-column') == '7') ? 'selected="selected"' : ''; ?>
                                value="7">7
                            </option>
                            <option <?php echo ($slide->get('r-column') == '8') ? 'selected="selected"' : ''; ?>
                                value="8">8
                            </option>
                            <option <?php echo ($slide->get('r-column') == '9') ? 'selected="selected"' : ''; ?>
                                value="9">9
                            </option>
                            <option <?php echo ($slide->get('r-column') == '10') ? 'selected="selected"' : ''; ?>
                                value="10">10
                            </option>
                            <option <?php echo ($slide->get('r-column') == '11') ? 'selected="selected"' : ''; ?>
                                value="11">11
                            </option>
                            <option <?php echo ($slide->get('r-column') == '12') ? 'selected="selected"' : ''; ?>
                                value="12">12
                            </option>
                        </select>
                    </div>
                    <div class="slider-element slider-text">
                        <label>Effect</label>
                        <?php $r_effect = $slide->get('r-effect'); ?>
                        <select name="r-effect" class="span12">
                            <?php echo ZtSlideshowHelperHelper::effectSlider($r_effect); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>