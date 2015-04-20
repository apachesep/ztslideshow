<?php
/* {$id} */

$doc = JFactory::getDocument();
//    $doc->addScriptDeclaration($script);
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/vendor/jquery.easing.1.3.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.min.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/html5lightbox/html5lightbox.js');
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/background-video/js/index.js');
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
                    <?php if ($slideParams->get('background-image-color')) { ?>
                        <div id="full-background-color" class="full-background"
                             style="<?php echo $styleColor; ?>"></div>
                    <?php } ?>
                    <?php if ($slideParams->get('background-image')) { ?>
                        <div id="full-background-image" class="full-background" style='<?php echo $style; ?> display: none;'>
                            <img src="<?php echo $slideParams->get('background-image'); ?>">
                        </div>
                    <?php } ?>
                    <?php if ($slideParams->get('background-video-webm') || $slideParams->get('background-video-mp4')) { ?>
                    <div id="full-background-video" class="full-background" style="display: none;">
                            <video id="bgvid">
                                <source src="<?php echo $slideParams->get('background-video-webm') ?>"
                                        type="video/webm">
                                <source src="<?php echo $slideParams->get('background-video-mp4') ?>" type="video/mp4">
                            </video>
                            <?php if ($slideParams->get('button-mute')) { ?>
                                <p id="btn-volumn">
                                    <i class="fa fa-volume-up" onclick="muteBxSlider(this);"></i>
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
    slider = jQuery('#<?php echo $_id; ?>').bxSlider({
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
        pager: true,
        <?php } ?>
        <?php
        if (!$params->get('navigation'))
        {
            ?>
        controls: true,
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
    var $wrapper = jQuery('.zt-slideshow-wrap .zt-slidershow-item');
    $wrapper = $wrapper.not('.bx-clone');
    $wrapper = $wrapper.find('.full-background-wrap');
    $wrapper.each(function(){
        var $color = jQuery(this).find('#full-background-color');
        var $image = jQuery(this).find('#full-background-image img');
        var $video = jQuery(this).find('#full-background-video video');
        $image.load(function(){
            jQuery(this).parent().fadeIn();
        });
        if($image.length > 0){
            if($image.prop('tagName') === 'IMG'){
                if($image[0].complete){
                    $image.trigger('load');
                }
            }
        }
        if($video.length > 0){
            if($video.prop('tagName') === 'VIDEO'){
                $video[0].addEventListener('loadeddata', function(){
                    jQuery(this).parent().fadeIn();
                    jQuery(this).prop('loop', true);
                    this.play();
                });
            }
        }
    });
    muteBxSlider = function(el){
        var $this = jQuery(el);
        var $video = $this.parent().prev();
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
</script>