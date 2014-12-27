<?php

namespace wolfguard\block\widgets;

use yii\web\AssetBundle;

/**
* Block asset bundle
*
* @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
*/
class BlockAsset extends AssetBundle
{
    public $sourcePath = '@vendor/wolfguard/yii2-block/widgets/views/block/assets';
    public $css = [
        'block.css',
    ];
    public $js = [
        'block.js',
    ];
}