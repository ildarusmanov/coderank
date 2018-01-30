<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdn.datatables.net/v/bs/dt-1.10.16/fh-3.1.3/r-2.2.1/sc-1.4.4/datatables.min.css',
        'css/site.css',
    ];
    public $js = [
        'https://cdn.datatables.net/v/bs/dt-1.10.16/fh-3.1.3/r-2.2.1/sc-1.4.4/datatables.min.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
