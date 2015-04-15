<?php
/* {$id} */

$doc = JFactory::getDocument();
//    $doc->addScriptDeclaration($script);
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.min.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/background-video/js/index.js');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/background-video/css/style.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/style.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/animation.css');
$_id = 'zt-slider-show' . rand(12345, 98765);
?>

<div class="zt-slideshow" id="<?php echo $_id; ?>">
    <?php foreach ($slides as $slide) : ?>
        <?php $slideParams = $slide['params']; ?>

        <?php
        $style = $styleColor = '';
        if ($slideParams->get('background-type') == 'image') {
            $style .= 'background-image: url("' . $slideParams->get('background-image') . '");';
            if($slideParams->get('background-opacity')){
                $style .= ' opacity: '. $slideParams->get('background-opacity') .';';
            }
            if($slideParams->get('background-image-color')){
                $styleColor .= 'background-color: '. $slideParams->get('background-image-color') .';';
            }
        }
        if ($slideParams->get('background-type') == 'color') {
            $style .= 'background-color:' . $slideParams->get('background-color') . ';';
        }
        ?>
        <div class="zt-slidershow-item">
            <?php if($slideParams->get('background-type') == 'video') { ?>
                <div class="full-background-wrap">
                    <div class="full-background">
                        <video autoplay  poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" loop>
                            <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
                            <source src="//demosthenes.info/assets/videos/polina.webm" type="video/webm">
                            <source src="<?php echo $slideParams->get('background-video') ?>" type="video/mp4">
                        </video>
                    </div>
                </div>

            <?php } else { ?>
                <div class="full-background-wrap" style="<?php echo $styleColor; ?>">
                    <div class="full-background"
                         style="<?php echo $style; ?>">
                    </div>
                </div>
            <?php } ?>

            <div class="container">
                <div class="row">
                    <!-- Left -->
                    <?php $item = $slide['left']; ?>
                    <?php if ($item->get('column') != 'none') : ?>
                        <div
                            class="left zt-slider-position <?php echo 'col-md-' . $item->get('column') . ' col-sm-' . $item->get('column'); ?>">
                            <?php $item = $slide['left']; ?>
                            <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Right -->
                    <?php $item = $slide['right']; ?>
                    <?php if ($item->get('column') != 'none') : ?>
                        <div
                            class="right zt-slider-position <?php echo 'col-md-' . $item->get('column') . ' col-sm-' . $item->get('column'); ?>">
                            <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    slider = jQuery('#<?php echo $_id; ?>').bxSlider({
        speed: <?php echo $params->get('transition_duration', 500); ?>,
        auto: true,
        pause: <?php echo $params->get('display_time', 4000); ?>,
        <?php
        if (!$params->get('pagination'))
        {
            ?>
        pager: false,
        <?php } ?>
        <?php
        if (!$params->get('navigation'))
        {
            ?>
        controls: false,
        <?php } ?>
        onSliderLoad: function () {
            jQuery("#<?php echo $_id; ?> > div:not('.bx-clone')").eq(0).addClass('active');
        },
        onSlideAfter: function () {
            jQuery("#<?php echo $_id; ?> div").removeClass('active');
            current = slider.getCurrentSlide();
            jQuery("#<?php echo $_id; ?> > div:not('.bx-clone')").eq(current).addClass('active');
        }
    });

</script>