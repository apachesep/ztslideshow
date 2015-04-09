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
<p class="animated <?php echo $item->get('effect'); ?>" style="animation-delay: 0.5s; -webkit-animation-delay: 0.5s; animation-duration: 0.7s;">
<img src="<?php echo $item->get('resized_image_url'); ?>" />
</p>