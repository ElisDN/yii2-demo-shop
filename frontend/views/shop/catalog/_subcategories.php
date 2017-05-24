<?php

/* @var $category shop\entities\Shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if ($category->children): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php foreach ($category->children as $child): ?>
                <a href="<?= Html::encode(Url::to(['/shop/catalog/category', 'id' => $child->id])) ?>"><?= Html::encode($child->name) ?></a> &nbsp;
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>