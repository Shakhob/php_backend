<?php

use yii\helpers\Url;

?>
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::home()?>" class="nav-link"><?=Yii::t('app','Home')?></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to('http://myproject/')?>" target="_blank" class="nav-link"><?=Yii::t('app','Site')?></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li>
        <li class="dropdown lang-dropdown" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=Yii::$app->language;?></a>
            <ul class="dropdown-menu custom-for-language">
                <?php
                $string = Yii::$app->request->url;
                $keywords = array("/en", "/ru", "/uz");
                $trimmedString = str_replace($keywords, "", $string);
                ?>
                <li><a href="<?php  echo Yii::$app->urlManager->createUrl([$trimmedString, 'language' => 'uz'])?>">uz</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl([$trimmedString, 'language' => 'ru']) ?>">ru</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl([$trimmedString, 'language' => 'en']) ?>">en</a></li>
            </ul>
        </li>
        </li>
        <li class="nav-item dropdown">
            <a href="<?=\yii\helpers\Url::to('/site/logout')?>" class="dropdown-item notify-item">
                <span>Выйти из аккаунта</span>
            </a>
        </li>
    </ul>
</nav>