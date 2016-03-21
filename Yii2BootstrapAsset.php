<?php

namespace chervand\bootstrap;

use yii\web\AssetBundle;

class Yii2BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/chervand/yii2-bootstrap';
    public $js = [
        'assets/ajax-dropdown.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
