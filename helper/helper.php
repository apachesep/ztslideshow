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
            $slide = new JObject($slide);
            return $slide;
        }

    }

}