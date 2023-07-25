<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Панель управления';
?>
<div class="admin-panel">
  <div class="posts-page admin">
    <div class='section-wrapper'>
      <div>
        <div class='breadcrumbs'>
          <a href='/'>Главная</a> / Панель управления
        </div>
        <div class='posts-page__title'>
          <h2>Панель управления</h2>
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
            'label' => 'Имя',
            'attribute' => 'name',
          ],
          [
            'label' => 'Фамилия',
            'attribute' => 'surname',
          ],
          [
            'label' => 'Логин',
            'attribute' => 'login',
          ],
          [
            'label' => 'Эл. почта',
            'attribute' => 'email',
          ],
          [
            'attribute' => 'role_id',
            'label' => 'Пользовательская роль',
            'value' => fn($model) => $roles[$model->role_id],
            'filter' => $roles,
          ],
          [
            'attribute' => 'direction_id',
            'label' => 'Направление',
            'value' => fn($model) => $directions[$model->direction_id],
            'filter' => $directions,
          ],
          [
            'label' => 'Действия',
            'value' => function($model) use($roles){
              return "<div class='admin-buttons'>"
              . ($roles[$model->role_id] == 'Студент' ? Html::a('Назначить менеджером', ['assign', 'id' => $model->id],
              ['class' => 'btn admin-button']) : '') .
              Html::a('Удалить аккаунт', ['delete', 'id' => $model->id], ['class' => 'btn admin-button', 'data-method' => 'post']) .
              "</div>";
            },
            'format' => 'raw',
          ],
        ],
      ]); ?>
    </div>
  </div>
</div>
