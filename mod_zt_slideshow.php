<?php

require_once __DIR__ . '/bootstrap.php';

$slides = json_decode($params->get('slides'));

$slide = new stdClass();
$slide->type = 'image';
$slide->name = 'test';

$slides[] = $slide;
$slides[] = $slide;
$slides[] = $slide;

$slides = ZtSlideshowHelperHelper::prepare($slides, $params);
require JModuleHelper::getLayoutPath('mod_zt_slideshow', $params->get('layout', 'default'));
