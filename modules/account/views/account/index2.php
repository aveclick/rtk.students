<?php

use app\models\User;
use app\models\ApplicationToCouncil;
use app\models\EventUser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Tabs;

$this->title = 'Личный кабинет';
?>
<div class="account">
  <div class="posts-page">
    <div class='section-wrapper'>
      <div class='breadcrumbs'>
        <a href='/'>Главная</a> / Личный кабинет
      </div>
      <div class='posts-page__title'>
        <h2>Личный кабинет</h2>
      </div>
      <?php
      $tab1content = GridView::widget([
        'dataProvider' => $dataProvider1,
        'filterModel' => $searchModel1,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-condensed'],
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
            'label' => 'Имя',
            'value' => 'name',
          ],
          [
            'label' => 'Фамилия',
            'value' => 'surname',
          ],
          [
            'label' => 'Логин',
            'value' => 'login',
          ],
          [
            'label' => 'Эл. почта',
            'value' => 'email',
          ],
          [
            'label' => 'Действия',
            'value' => function($model){
              return "<div class='admin-buttons'>"
              . Html::a('Редактировать профиль', ['update', 'id' => $model->id],
              ['class' => 'btn admin-button']) .
              Html::a('Сменить пароль', ['password-change', 'id' => $model->id], ['class' => 'btn admin-button']) .
              "</div>";
            },
            'format' => 'raw',
          ],
        ],
      ]);

      $tab2content = GridView::widget([
        'dataProvider' => $dataProvider2,
        'filterModel' => $searchModel2,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-condensed'],
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
            'label' => 'Название',
            'value' => function($model){
              return Html::a($model->event->title, Url::to(["/event/view?id={$model->event->id}"]));
            },
            'format' => 'raw',
          ],
          [
            'label' => 'Дата и время проведения',
            'value' => fn($model) => $model->event->date,
          ],
          [
            'label' => 'Действия',
            'value' => function($model){
              return "<div class='admin-buttons'>"
              . Html::a('Удалить', ['delete-event', 'id' => $model->id],
              ['class' => 'btn admin-button', 'data-method' => 'post']) .
              "</div>";
            },
            'format' => 'raw',
          ],
        ],
      ]);

      echo Tabs::widget([
        'items' => [
          [
            'label' => 'Общая информация',
            'content' => $tab1content,
            'active' => true
          ],
          [
            'label' => 'Мероприятия',
            'content' => $tab2content,
          ],
        ]
      ]);
      ?>
    </div>
  </div>
</div>
