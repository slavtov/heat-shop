<?php
$parent = isset($category['childs']);
if ($parent) {
    $delete = '<i class="fas fa-trash h5"></i>';
} else {
    $delete = '<a href="' . ADMIN . '/category/delete?id=' . $id . '" class="delete"><i class="fas fa-trash text-danger h5"></i></a>';
}
?>

    <li class="list-group-item d-flex justify-content-between align-items-center rounded mb-2">
        <div>
            <a href="<?=ADMIN;?>/category/edit?id=<?=$id;?>">
                <h5><?=$category['title'];?>&nbsp;<i class="fas fa-edit h6"></i></h5>
            </a>
            <p><?=$category['description'];?></p>
        </div>
        <?=$delete;?>
    </li>

<?php if ($parent): ?>
    <div class="ml-5 mb-4">
        <?=$this->getMenuHtml($category['childs']);?>
    </div>
<?php endif; ?>