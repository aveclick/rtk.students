<?php

use app\models\ApplicationToCouncil;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\manager\models\ManagerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Панель управления';
?>
<div class="manager-panel">
  <div class="posts-page admin">
    <div class='section-wrapper'>
      <div>
        <div class='breadcrumbs'>
          <a href='/'>Главная</a> / Панель управления / Управление заявками
        </div>
        <div class='posts-page__title'>
          <h2>Панель управления</h2>
        </div>
        <div class="manager-panel__container">
        <div class='posts-page__title'>
          <h3>Управление заявками</h3>
        </div>
        <div class='manager-panel__main-btn'>
          <?= Html::a('Управление новостями', ['/manager/post'], ['class' => 'btn right-btn'])?>
          <?= Html::a('Управление мероприятиями', ['/manager/event'], ['class' => 'btn'])?>
        </div>
      </div>
      </div>
      <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-condensed'],
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
            'label' => 'Студент',
            'value' => fn($model) => $model->user->name . ' ' .  $model->user->surname,
          ],
          [
            'label' => 'Дата подачи заявки',
            'value' => fn($model) => date('d.m.Y', strtotime($model->created_at)),
          ],
          [
            'attribute' => 'status_id',
            'label' => 'Статус',
            'value' => fn($model) => $statuses[$model->status_id],
            'filter' => $statuses,
          ],
          [
            'label' => 'Примечание',
            'attribute' => 'reason',
          ],
          [
            'label' => 'Действия',
            'value' => function($model) use($statuses){
              return ($statuses[$model->status_id] == 'Новая' ? "<div class='admin-buttons'>" .
              Html::a('Подтвердить', ['confirm', 'id' => $model->id], ['class' => 'btn admin-button']) .
              Html::a('Отменить', ['cancel', 'id' => $model->id], ['class' => 'btn admin-button']) .
              "</div>" : '' );
            },
            'format' => 'raw',
          ],
        ],
      ]); ?>
    </div>
  </div>
</div>
