<?php
/* {$id} */

$doc = JFactory::getDocument();
//    $doc->addScriptDeclaration($script);
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/vendor/jquery.easing.1.3.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.min.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/html5lightbox/html5lightbox.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/background-video/js/jquery.video.parallax.js');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/background-video/css/style.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/style.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/animation.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/fontawesome/css/font-awesome.min.css');
$_id = 'zt-slider-show' . rand(12345, 98765);
?>
<div class="zt-slideshow-wrap" style="width: <?php echo $params->get('slider_width'); ?>">
    <div class="zt-slideshow" id="<?php echo $_id; ?>">
        <?php foreach ($slides as $slide) : ?>
            <?php $slideParams = $slide['params']; ?>

            <?php
            $style = $styleColor = '';
            if ($slideParams->get('background-opacity')) {
                $style .= ' opacity: ' . $slideParams->get('background-opacity') . ';';
            }
            if ($slideParams->get('background-image-color')) {
                $styleColor .= 'background-color: ' . $slideParams->get('background-image-color') . ';';
            }
            ?>
            <div class="zt-slidershow-item">
                <div class="full-background-wrap">
                    <?php if ($slideParams->get('background-video-webm') || $slideParams->get('background-video-mp4')) { ?>
                    <div 
                        id="full-background-video" 
                        class="full-background" 
                        style="min-height: <?php echo $params->get('slider_height'); ?>px;"
                        data-video-file-mp4="<?php echo $slideParams->get('background-video-mp4') ?>"
                        data-video-file-webm="<?php echo $slideParams->get('background-video-mp4') ?>"
                        data-sound="false"
                        data-width="1288"
                        data-height="724"
                        data-link-image-poster="<?php echo ($slideParams->get('background-image') !== '')? $slideParams->get('background-image') : ''; ?>"
                        data-overlay-color="<?php echo($slideParams->get('background-image-color')!== '')? $slideParams->get('background-image-color') : ''; ?>"
                        data-overlay-opacity="0">
                        <?php if ($slideParams->get('button-mute') === 'enable') { ?>
                            <p id="btn-volumn">
                                <i class="fa fa-volume-off" onclick="muteBxSlider(this);"></i>
                            </p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
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
</div>
<style rel="stylesheet" type="text/css">
    .zt-slideshow .zt-slidershow-item {
        min-height: <?php echo $params->get('slider_height'); ?>;
        height: <?php echo $params->get('slider_height'); ?>;
    }

    .zt-slideshow .zt-slider-position {
        height: <?php echo $params->get('slider_height'); ?>;
    }
</style>
<script type="text/javascript">
(function(w){
    if(typeof(w.jQuery) === 'undefined'){
        console.log('ERROR! jQuery was not loaded !');
        return false;
    }else{
        var $ = jQuery
    }
    
    var bxSliderSettings = {
        speed: <?php echo $params->get('transition_duration', 500); ?>,
        <?php if($params->get('autoplay')) { ?>
        auto: true,
        <?php } ?>
        <?php if($params->get('effects') != 'none') { ?>
        useCSS: false,
        easing: '<?php echo $params->get('effects'); ?>',
        <?php } ?>
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
            $("#<?php echo $_id; ?> > div:not('.bx-clone')").eq(0).addClass('active');
        },
        onSlideAfter: function () {
            $("#<?php echo $_id; ?> div").removeClass('active');
            current = slider.getCurrentSlide();
            $("#<?php echo $_id; ?> > div:not('.bx-clone')").eq(current).addClass('active');
        }
    };
    slider = $('#<?php echo $_id; ?>').bxSlider(bxSliderSettings);
    jQuery("#full-background-video").bgVideo();
    muteBxSlider = function(el){
        var $this = jQuery(el);
        var $video = $this.closest('#full-background-video').find('video');
        if($this.hasClass('fa-volume-up')){
            $this.removeClass('fa-volume-up');
            $this.addClass('fa-volume-off');
            $video.prop('muted', true);
        }else{
            $this.removeClass('fa-volume-off');
            $this.addClass('fa-volume-up');
            $video.prop('muted', false);
        }
    };
    
})(window);
    
</script>