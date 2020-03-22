<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?=$this->meta['title']; ?>
    </title>

<?php if (!empty($this->meta['desc'])): ?>
    <meta name="description" content="<?=$this->meta['desc']; ?>">
<?php endif; ?>

<?php if (!empty($this->meta['keywords'])): ?>
    <meta name="keywords" content="<?=$this->meta['keywords']; ?>">
<?php endif; ?>
</head>

<body>
    <h1>Default layout</h1>

    <?=$content; ?>
</body>
</html>