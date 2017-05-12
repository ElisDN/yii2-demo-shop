<?php

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <aside id="column-left" class="col-sm-3 hidden-xs">
        <div class="list-group">
            <a href="/product/category&amp;path=20" class="list-group-item">Desktops (13)</a>
            <a href="/product/category&amp;path=18" class="list-group-item">Laptops &amp; Notebooks (5)</a>
            <a href="/product/category&amp;path=25" class="list-group-item">Components (2)</a>
            <a href="/product/category&amp;path=57" class="list-group-item">Tablets (1)</a>
            <a href="/product/category&amp;path=17" class="list-group-item">Software (0)</a>
            <a href="/product/category&amp;path=24" class="list-group-item">Phones &amp; PDAs (3)</a>
            <a href="/product/category&amp;path=33" class="list-group-item">Cameras (2)</a>
            <a href="/product/category&amp;path=34" class="list-group-item">MP3 Players (4)</a>
        </div>
    </aside>
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
</div>

<?php $this->endContent() ?>
