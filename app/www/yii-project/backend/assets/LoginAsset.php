<?php


namespace backend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback",
        'plugins/fontawesome-free/css/all.min.css',
        'dist/css/adminlte.min.css'
    ];
    public $js = [
//        "plugins/jquery/jquery.min.js",
        "plugins/bootstrap/js/bootstrap.bundle.min.js",
        "dist/js/adminlte.min.js"
    ];
    public $depends = [

    ];
}