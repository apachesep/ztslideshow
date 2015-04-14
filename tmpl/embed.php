<?php

/* {$id} */
?>
<div class="ps-<?php echo ($item->get('position')) ? $item->get('position') : 'none'; ?> animated <?php echo ($item->get('effect')) ? $item->get('effect') : 'none'; ?>">
    <?php echo $item->getEmbed(); ?>
</div>