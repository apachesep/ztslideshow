<?php
/* {$id} */
?>

<div class="content-text ps-<?php echo $item->get('position'); ?>">
    <p class="small-title animated <?php echo $item->get('effect'); ?>"
       style="animation-delay: 0.2s; -webkit-animation-delay: 0.2s;"><?php echo $item->get('text-title'); ?></p>

    <h3 class="title animated <?php echo $item->get('effect'); ?>"
        style="animation-delay: 0.5s; -webkit-animation-delay: 0.5s;"><?php echo $item->get('text-stitle'); ?></h3>

    <p class="description animated <?php echo $item->get('effect'); ?>"
       style="animation-delay: 0.8s; -webkit-animation-delay: 0.8s;"><?php echo $item->get('text-des') ?></p>

    <p class="link animated <?php echo $item->get('effect'); ?>"
       style="animation-delay: 1s; -webkit-animation-delay: 1s;"><a href="<?php echo $item->get('link'); ?>"><?php echo $item->get('text-link'); ?></a></p>
</div>