<?php

use app\models\Event;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Мероприятия';
?>
<div class="posts-page">
  <div class="section-wrapper">
    <div class="posts-section">
      <div class="posts-section__title">
        <h2>Мероприятия</h2>
      </div>
    </div>
    <?php Pjax::begin([
      'id' => 'posts_pjax',
      'timeout' => 5000,
      'enablePushState' => false
    ]); ?>
    <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories, 'directions' => $directions, 'dataProvider' => $dataProvider]); ?>
    <?php if (Yii::$app->session->hasFlash('eventAddSubmitted')): ?>
      <div class="alert alert-success">
        Мероприятие успешно добавлено в Ваш личный кабинет :)
      </div>
    <?php endif;?>
    <?php if (Yii::$app->session->hasFlash('eventAddNotSubmitted')): ?>
      <div class="alert alert-danger">
        Мероприятие уже было раннее добавлено в Ваш личный кабинет :)
      </div>
    <?php endif;?>
    <?= ListView::widget([
      'layout' => '{pager}<div class="news-section__cards row row-cols-1 row-cols-md-3 g-4">{items}</div>{pager}',
      'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
      'dataProvider' => $dataProvider,
      'itemOptions' => ['class' => 'col card'],
      'itemView' => function ($model, $key, $index, $widget) {
        return Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
        "<div class='card-body'>
        <div class='card-date'>Дата публикации: " . date('d.m.Y', strtotime($model->created_at)) . "</div>
        <h5 class='card-title'>".Html::a(Html::encode($model->title), ['view', 'id' => $model->id])."</h5>
        <h4 class='card-datetime'>" . date('d.m.Y H:i', strtotime($model->date)) . "</h4>
        <div class='card-text'>" . StringHelper::truncateWords((strip_tags($model->text)), 23, ' ...') . "</div>" .
        ((!Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin) && ($model->date >= date('Y-m-d H:i:s')) ?
        "<div class='card-footer-add'>" .
        Html::a('Добавить', ['add', 'id' => $model->id], ['class' => 'btn']) .
        "</div>" : '') .
        "</div>";
      },
      ]) ?>
      <?php Pjax::end(); ?>
  </div>
</div>
