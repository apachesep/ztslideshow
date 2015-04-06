<?php

if (!class_exists('ZtSlideshowHelperHelper'))
{

    class ZtSlideshowHelperHelper
    {

        public static function prepare($slides, $params)
        {
            foreach ($slides as $slide)
            {
                switch ($slide->type)
                {
                    case 'image':
                        $list[] = self::imagePrepare($slide, $params);
                        break;
                }
            }
            return $list;
        }

        public static function imagePrepare($slide, $params)
        {
            require_once '../libraries/image.php';
            $image = new ZtSlideshowImage($slide);
            $image->set('params', $params);
            return $image;
        }

        public static function embedPrepare($slide, $params)
        {
            require_once '../libraries/embed.php';
            $embed = new ZtSlideshowEmbed($slide);
            $embed->set('params', $params);
            return $embed;
        }

    }

}