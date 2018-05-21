<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/AdminLTE.css',
      'css/skins/skin-green.css',
      'font-awesome/css/font-awesome.min.css',
      'css/style.css'
    ];
    public $js = [
      'js/adminlte.min.js',
    ];
    public $depends = [
       'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset',
    ];
}
