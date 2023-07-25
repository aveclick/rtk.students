<?php

use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\manager\models\Post_depSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Панель управления';
?>
<div class="manager-panel">
  <div class="posts-page admin">
    <div class='section-wrapper'>
      <div>
        <div class='breadcrumbs'>
          <a href='/'>Главная</a> / Панель управления / Управление мероприятиями
        </div>
        <div class='posts-page__title'>
          <h2>Панель управления</h2>
        </div>
        <div class="manager-panel__container">
          <div class='posts-page__title'>
            <h3>Управление мероприятиями</h3>
          </div>
          <div class='manager-panel__main-btn'>
            <?= Html::a('Управление заявками', ['/manager'], ['class' => 'btn right-btn'])?>
            <?= Html::a('Управление новостями', ['/manager/post'], ['class' => 'btn'])?>
          </div>
        </div>
        <div class="manager-panel__create-container">
          <?= Html::a('Добавить', ['create'], ['class' => 'btn'])?>
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
            'label' => 'Дата публикации',
            'value' => fn($model) => date('d.m.Y', strtotime($model->created_at)),
          ],
          [
            'label' => 'Название',
            'value' => function($model){
              return "<div class='post-link'>" . Html::a($model->title, Url::to(["/event/view?id={$model->id}"])) . "</div>";
            },
            'format' => 'raw',
          ],
          [
            'label' => 'Дата и время проведения',
            'value' => fn($model) => date('d.m.Y H:i', strtotime($model->date)),
          ],
          [
            'label' => 'Действия',
            'value' => function($model) use($statuses){
              return "<div class='admin-buttons'>" .
              Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn admin-button']) .
              Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn admin-button', 'data-method' => 'post']) .
              "</div>";
            },
            'format' => 'raw',
          ],
        ],
      ]); ?>
    </div>
  </div>
</div>
