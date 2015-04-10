<?php

/* {$id} */

$doc = JFactory::getDocument();
//    $doc->addScriptDeclaration($script);
$doc->addScript(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.min.js');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/bxslider/jquery.bxslider.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/style.css');
$doc->addStyleSheet(JUri::root() . '/modules/mod_zt_slideshow/assets/css/front/animation.css');
$_id = 'zt-slider-show' . rand(12345, 98765);
?>

<div class="zt-slideshow" id="<?php echo $_id; ?>">
    <?php foreach ($slides as $slide) : ?>
        <?php $slideParams = $slide['params']; ?>
        <div class="zt-slidershow-item">
            <div class="full-backround"
                 style="background-image: url('<?php echo $slideParams->get('background-image'); ?>'); background-color: <?php echo $slideParams->get('background-color'); ?>"></div>
            <div class="container">
                <div class="row">
                    <?php
                    $item = $slide['left'];
                    if ($item->get('column') != 'none')
                    {
                        ?>

                        <div
                            class="left zt-slider-position <?php echo 'col-md-' . $item->get('column') . ' col-sm-' . $item->get('column'); ?>">
                                <?php $item = $slide['left']; ?>
                                <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
                        </div>
                        <?php
                    }
                    $item = $slide['right'];
                    if ($item->get('column') != 'none')
                    {
                        ?>
                        <div
                            class="right zt-slider-position <?php echo 'col-md-' . $item->get('column') . ' col-sm-' . $item->get('column'); ?>">
                            <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
                        </div>
                    <?php } ?>
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