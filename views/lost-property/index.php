<?php

use app\models\LostItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="posts-page">
  <div class="section-wrapper">
    <div class="posts-section">
      <div class="posts-section__title">
        <h2>Бюро находок</h2>
      </div>
      <?php if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin): ?>
        <div class='posts-section__btn'>
          <?= Html::a('Добавить', ['/lost-property/create'], ['class' => 'btn'])?>
        </div>
      <?php endif ?>
    </div>
    <?php Pjax::begin([
      'id' => 'news_pjax',
      'timeout' => 5000,
      'enablePushState' => false
    ]); ?>
    <?= $this->render('_search', ['model' => $searchModel, 'dataProvider' => $dataProvider]); ?>
    <?= ListView::widget([
      'layout' => '{pager}<div class="news-section__cards row row-cols-1 row-cols-md-3 g-4">{items}</div>{pager}',
      'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
      'dataProvider' => $dataProvider,
      'itemOptions' => ['class' => 'col card'],
      'itemView' => function ($model, $key, $index, $widget) {
        return Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
        "<div class='card-body'>
        <div class='card-date'>Дата публикации: " . date('d.m.Y', strtotime($model->created_at)) . "</div>
        <h5 class='card-title'>$model->title</h5>
        <div class='card-text'>" . strip_tags($model->text) . "</div>"
        . (!Yii::$app->user->isGuest && $model->rules == false ?
        "<div class='card-footer-add'>
        <button class='not-show-btn'>Показать контакты для связи<span>" . $model->user->email . "</span></button></div>" : '') .
        "</div>";
      },
      ]) ?>
      <?php Pjax::end(); ?>
    </div>
  </div>
