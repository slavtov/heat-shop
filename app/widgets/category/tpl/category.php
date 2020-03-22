<?php if (!$category['parent_id']): ?>
<?php if (isset($category['childs'])): ?>
<div class="btn dropdown position-static pl-0">
    <a class="btn bg-white shadow-sm hover-shadow dropdown-toggle" href="category/<?=$category['alias'];?>" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?=$category['title'];?>
    </a>

    <div class="dropdown-menu mt-1 border-0 p-0" aria-labelledby="dropdownMenuLink">
        <div class="row rounded m-0 shadow">
            <div class="col">
                <div class="row <?=!$category['img'] ? 'py-5 text-center' : 'p-5';?>">
                    <?=$this->getMenuHtml($category['childs']);?>
                </div>
            </div>
        <?php if ($category['img']): ?>
            <div class="col rounded-right" style="background: center center url(img/<?=$category['img'];?>)no-repeat; background-size: cover;"></div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php else: ?>
<a href="category/<?=$category['alias'];?>" class="btn bg-white shadow-sm hover-shadow mr-3">
    <?=$category['title'];?>
</a>
<?php endif; ?>
<?php else: ?>
<?php if (isset($category['childs'])): ?>
<div class="col mb-4">
    <h6 class="font-weight-bold text-uppercase">
        <a href="category/<?=$category['alias'];?>" class="text-dark">
            <?=$category['title'];?>
        </a>
    </h6>
    <?=$this->getMenuHtml($category['childs']);?>
</div>
<?php else: ?>
<a class="dropdown-item" href="category/<?=$category['alias'];?>">
    <?=$category['title'];?>
</a>
<?php endif; ?>
<?php endif; ?>