<?php
/* {$id} */
?>

<div class="content-text ps-<?php echo ($item->get('position')) ? $item->get('position') : 'none'; ?>">
    <?php if (!empty($item->get('text-title'))) : ?>
        <p class="small-title animated <?php echo ($item->get('effect')) ? $item->get('effect') : ''; ?>"
           style="animation-delay: 0.2s; -webkit-animation-delay: 0.2s;">
               <?php echo ($item->get('text-title')) ? $item->get('text-title') : ''; ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($item->get('text-stitle'))) : ?>
        <h3 class="title animated <?php echo ($item->get('effect')) ? $item->get('effect') : ''; ?>"
            style="animation-delay: 0.5s; -webkit-animation-delay: 0.5s;">
            <?php echo ($item->get('text-stitle')) ? $item->get('text-stitle') : ''; ?></h3>
    <?php endif; ?>
    <?php if (!empty($item->get('text-des'))) : ?>
        <p class="description animated <?php echo ($item->get('effect')) ? $item->get('effect') : ''; ?>"
           style="animation-delay: 0.8s; -webkit-animation-delay: 0.8s;">
            <?php echo ($item->get('text-des')) ? $item->get('text-des') : ''; ?></p>
    <?php endif; ?>
    <?php if (!empty($item->get('link')) && !empty($item->get('text-link'))) : ?>
        <p class="zt-readmore animated <?php echo ($item->get('effect')) ? $item->get('effect') : ''; ?>"
           style="animation-delay: 1s; -webkit-animation-delay: 1s;">
            <a href="<?php echo ($item->get('link')) ? $item->get('link') : ''; ?>"><?php echo ($item->get('text-link')) ? $item->get('text-link') : ''; ?></a>
        </p>
    <?php endif; ?>
</div>