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
            <?php
            $slideParams = $slide['params']; 
            $style = 'display: none;';
            $styleColor = ($slideParams->get('background-image-color', '') != '') ? 'background-color: ' . $slideParams->get('background-image-color') . ';' : '';
            $opactity = ($slideParams->get('color-overlay-opacity','') != '') ? ' opacity: ' . $slideParams->get('color-overlay-opacity', 1) . ';' : '';
            if($slideParams->get('background-video-webm', '') == '' 
                    && $slideParams->get('background-video-mp4', '') == ''
                    && $slideParams->get('background-image-color', '') != '') {
                    $opactity = ($slideParams->get('color-overlay-opacity','') != '') ? ' opacity: ' . (1 - $slideParams->get('color-overlay-opacity', 1)) . ';' : '';
            }
            ?>
            <div class="zt-slidershow-item">
                <div class="full-background-wrap">
                    <?php if ($slideParams->get('background-video-webm', '') == '' && $slideParams->get('background-video-mp4', '') == '') { ?>
                        <?php if ($slideParams->get('background-image-color', '') != '') { ?>
                            <div id="full-background-color" class="full-background"
                               style="<?php echo $styleColor; ?>"></div>
                        <?php } ?>                    
                        <?php if ($slideParams->get('background-image', '') != '') { ?>
                            <div id="full-background-image" class="full-background" style='<?php echo $style . $opactity; ?>'>
                                <img style="display: none;" src="<?php echo $slideParams->get('background-image'); ?>">
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div 
                            id="full-background-video" 
                            class="full-background" 
                            style="min-height: <?php echo $params->get('slider_height'); ?>;min-width: <?php echo $params->get('slider_width'); ?>;"
                            data-video-file-mp4="<?php echo $slideParams->get('background-video-mp4') ?>"
                            data-video-file-webm="<?php echo $slideParams->get('background-video-webm') ?>"
                            data-sound="false"
                            data-link-image-poster="<?php echo ($slideParams->get('background-image') !== '')? $slideParams->get('background-image') : ''; ?>"
                            data-overlay-color="<?php echo($slideParams->get('background-image-color')!== '')? $slideParams->get('background-image-color') : ''; ?>"
                            data-overlay-opacity="<?php echo($opactity); ?>">
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
    var $wrapper = $('.zt-slideshow-wrap .zt-slidershow-item');
    $wrapper = $wrapper.not('.bx-clone');
    $wrapper = $wrapper.find('.full-background-wrap');
    $wrapper.each(function(){
        var $color = $(this).find('#full-background-color');
        var $image = $(this).find('#full-background-image img');
        $image.load(function(){
            var $parent = $(this).parent();
            console.log($parent);
            $parent.fadeIn();
            $parent.css('background-image', "url('" + $(this).attr('src') + "')");
        });
        if($image.length > 0){
            if($image.prop('tagName') === 'IMG'){
                if($image[0].complete){
                    $image.trigger('load');
                }
            }
        }
    });
})(window);
    
</script>