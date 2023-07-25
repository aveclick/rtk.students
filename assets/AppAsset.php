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
    'css/fonts.css',
    'css/site.css',
    'css/reset.css',
    'css/style.css',
  ];
  public $cssOptions = [
    'type' => 'text/css',
  ];
  public $js = [
    'js/script.js',
    'https://kit.fontawesome.com/41705279fa.js',
  ];
  public $depends = [
    'yii\web\JqueryAsset',
    'yii\web\YiiAsset',
    'yii\bootstrap5\BootstrapAsset'
  ];
}
