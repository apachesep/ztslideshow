<?php

require_once __DIR__ . '/bootstrap.php';

$slides = json_decode($params->get('slides'));
echo '<pre>';
print_r ($slides);
echo '</pre>';
$slides = ZtSlideshowHelperHelper::prepare($slides, $params);

require JModuleHelper::getLayoutPath('mod_zt_slideshow', $params->get('layout', 'default'));
