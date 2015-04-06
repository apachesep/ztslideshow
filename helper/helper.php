<?php

if (!class_exists('ZtSlideshowHelperHelper'))
{

    class ZtSlideshowHelperHelper
    {

        public static function prepare($slides, $params)
        {

            foreach ($slides as $index => $slide)
            {
                $properties = get_object_vars($slide);
                $left = new JObject();
                $right = new JObject();
                foreach ($properties as $key => $value)
                {
                    if (substr($key, 0, 2) == 'l-')
                    {
                        $left->set(substr($key, 2), $value);
                    } else
                    {
                        $right->set(substr($key, 2), $value);
                    }
                }
                if ($left->get('type') == 'image')
                {
                    $list[$index]['left'] = self::imagePrepare($left, $params);
                } else
                {
                    $list[$index]['left'] = self::embedPrepare($left, $params);
                }
                if ($right->get('type') == 'image')
                {
                    $list[$index]['right'] = self::imagePrepare($right, $params);
                } else
                {
                    $list[$index]['right'] = self::embedPrepare($right, $params);
                }
            }
            return $list;
        }

        public static function imagePrepare($slide, $params)
        {
            require_once '/../libraries/image.php';
            $properties = $slide->getProperties();
            $properties['params'] = $params;
            $image = new ZtSlideshowImage($properties);
            return $image;
        }

        public static function embedPrepare($slide, $params)
        {
            require_once '../libraries/embed.php';
            $embed = new ZtSlideshowEmbed($slide->getProperties());
            $embed->set('params', $params);
            return $embed;
        }

    }

}