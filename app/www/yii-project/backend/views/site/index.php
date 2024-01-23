<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div>
    Xush kelibsiz <?=Yii::$app->user->identity->username?>
</div>

        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">

<div>
    <li class="dropdown lang-dropdown" >
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=Yii::$app->language;?></a>
        <ul class="dropdown-menu custom-for-language">
            <!--<li><a href=" <?php // echo Url::to(['/', 'language' => 'uz']) ?>">uz</a></li>
                            <li><a href=" <?php // echo Url::to(['/', 'language' => 'ru']) ?>">ru</a></li>-->
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
</div>