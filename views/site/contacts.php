<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\helpers\StringHelper;
use yii\bootstrap5\ActiveForm;
$this->title = 'Контакты';
?>
<div class="contacts-page">
  <div class="section-wrapper top">
    <div class="contacts-section">
      <div class="contacts-section__title">
        <h2>Контакты</h2>
      </div>
      <div class="contacts-section__container">
        <div class="contacts-section__content">
          <div class="contacts-section__items">
            <div class="contacts-section__item">
              <span>Адрес</span>
              <p>199155, г. Санкт-Петербург, наб. реки Смоленки, д. 1</p>
            </div>
            <div class="contacts-section__item">
              <span>Номер телефона</span>
              <p>(812) 405-85-38</p>
            </div>
            <div class="contacts-section__item">
              <span>Электронная почта</span>
              <p>Info@spb-rtk.ru</p>
            </div>
          </div>
        </div>
        <div class="contacts-section__image">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.0063432134605!2d30.26422607712893!3d59.94862897492014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696312d956bc111%3A0x3a60c856823f306d!2z0KDQsNC00LjQvtGC0LXRhdC90LjRh9C10YHQutC40Lkg0JrQvtC70LvQtdC00LY!5e0!3m2!1sru!2sru!4v1684826757514!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
  <?php if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin): ?>
    <div class="section-wrapper">
      <div class="feedback-section">
        <div class="feedback-section__title">
          <h2>Обратная связь</h2>
        </div>
        <div class="feedback-section__container">
          <div class="feedback-section__form">
            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
              <div class="alert alert-success">
                Спасибо за обращение к нам. Мы постараемся ответить Вам как можно скорее!
              </div>
            <?php else: ?>
              <?php $form = ActiveForm::begin([
                'id' => 'contact-form', /* идентификатор формы */
                'options' => ['class' => 'form-horizontal'], /* класс формы */
                'fieldConfig' => [ /* классы полей формы */
                  'template' => "{label}\n{input}\n{error}"
                ],
              ]); ?>
              <?= $form->field($model, 'subject')->textInput(['placeholder' => "Тема"]) ?>
              <?= $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder' => "Сообщение"]) ?>
              <div class="form-group">
                <?= Html::submitButton('Отправить сообщение', ['class' => 'btn', 'name' => 'contact-button']) ?>
              </div>
              <?php ActiveForm::end(); ?>
            <?php endif; ?>
          </div>
          <div class="feedback-section__content">
            <p>ОСТАЛИСЬ ВОПРОСЫ?</p>
            <span>СВЯЖИТЕСЬ С НАМИ, МЫ ПОМОЖЕМ!</span>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>
</div>
