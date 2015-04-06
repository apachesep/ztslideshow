<div class="zt-slideshow">
    <?php foreach ($slides as $slide) : ?>
        <div class="left">
            <?php $item = $slide['left']; ?>
            <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
        </div>
        <div class="right">
            <?php $item = $slide['right']; ?>
            <?php require __DIR__ . '/' . $item->get('type') . '.php'; ?>
        </div>
    <?php endforeach; ?>
</div>