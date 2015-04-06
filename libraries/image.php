<?php

if (!class_exists('ZtSlideshowImage'))
{

    class ZtSlideshowImage extends JObject
    {

        public function __construct($properties = null)
        {
            parent::__construct($properties);
            $this->_prepare();
            $this->set('img_path', JPATH_ROOT . '/' . $this->image);
        }

        private function _prepare()
        {
            $imager = new ZtSlideshowImager('gd');
            $imagePath = $this->get('img_path');
            $imageFileName = md5($imagePath);
            if (JFile::exists($imagePath))
            {
                $imager->loadFile($imagePath);
                $method = $this->params->get('resize_method', 'fit');
                if (method_exists($imager, $method))
                {
                    $imager->$method($this->params->get('width'), $this->params->get('height'));
                    $ext = JFile::getExt($imagePath);
                    $saveImagePath = JPATH_ROOT . '/cache/ztslideshow/' . $imageFileName . '.' . $ext;
                    if ($imager->saveToFile($saveImagePath))
                    {
                        $this->set('resized_image_url', JUri::root() . '/' . '/cache/ztslideshow/' . $imageFileName . '.' . $ext);
                    }
                }
            }
        }

        public function getImage()
        {
            
        }

    }

}