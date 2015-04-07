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

if (!class_exists('ZtSlideshowEmbed'))
{

    class ZtSlideshowEmbed extends JObject
    {

        public function __construct($properties = null)
        {
            parent::__construct($properties);
            $this->_prepare();
        }

        private function _prepare()
        {
            $uri = JUri::getInstance($this->get('embed'));
            $host = $uri->getHost();
            if ($host == 'www.youtube.com' || $host == 'youtube.com')
            {
                $id = $uri->getVar('v');
                $this->set('source', 'youtube');
                $this->set('id', $id);
            } else
            {
                // Vimeo
            }
        }

        public function getEmbed($attributes = array())
        {

            foreach ($attributes as $key => $value)
            {
                $htmlAttributes [] = $key . '="' . $value . '"';
            }
            if ($this->get('source') == 'youtube')
            {
                $htmlAttributes [] = 'width="560"';
                $htmlAttributes [] = 'height="315"';
                $htmlAttributes [] = 'src="//www.youtube.com/embed/w1jIyPWF9No' . $this->get('id') . '"';
                $html = '<iframe ' . implode(' ', $htmlAttributes) . ' frameborder="0" allowfullscreen></iframe>';
            }

            return $html;
        }

    }

}