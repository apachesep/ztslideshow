<?php foreach ($slides as $slide) : ?>
    <?php require_once __DIR__ . '/' . $slide->get('type') . '.php'; ?>
<?php endforeach; ?>