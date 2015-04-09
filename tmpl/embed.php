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
<div class="ps-<?php echo $item->get('position'); ?> animated <?php echo $item->get('effect'); ?>">
<?php echo $item->getEmbed(); ?>
</div>