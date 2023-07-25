<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
$this->title = $model->title;
?>
<?php
  echo "<div class='post-page'>
  <div class='section-wrapper top'>
  <div>
  <div class='breadcrumbs'>
  <a href='/post'>Новости</a> / " . $model->title .
  "</div>
  <div class='posts-section__title'>
  <h2>" . $model->title . "</h2>
  </div>
  </div>
  <div>
  <div class='post-section'>
  <div class='post-section__content'>
  <div class='post-section__text'>" . $model->text . "</div>
  </div>
  <div class='post-section__image'>" .
  Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
  "</div>
  </div>
  </div>
  </div>
  </div>";
?>
