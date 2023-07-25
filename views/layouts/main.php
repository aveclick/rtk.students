<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
  <?php $this->beginBody() ?>

  <header id="header">
    <?php
    NavBar::begin([
      'options' => ['class' => 'navbar-expand-xl navbar-dark']
    ]);
    echo "<div class='logo'>" . "<a href='/'><img src=\"/web/img/logo.svg\" alt=''></a>" . "</div>";
    echo Nav::widget([
      'options' => ['class' => 'navbar-nav'],
      'items' => [
        ['label' => 'Главная', 'url' => ['/']],
        [
          'label' => 'Отделы',
          'items' => [
            ['label' => 'Профессионально-ориентирующий отдел', 'url' => '/site/prof_dep'],
            ['label' => 'Учебный отдел', 'url' => '/site/training_dep'],
            ['label' => 'Культурно-творческий отдел', 'url' => '/site/cultural_dep'],
            ['label' => 'Физкультурно-оздоровительный отдел', 'url' => '/site/sport_dep'],
            ['label' => 'Гражданско-патриотический отдел', 'url' => '/site/civil_dep'],
            ['label' => 'Экологический отдел', 'url' => '/site/eco_dep'],
          ],
        ],
        [
          'label' => 'Проекты',
          'items' => [
            ['label' => 'Мультимедийный центр «жим»', 'url' => '/site/media_project'],
            ['label' => 'Волонтеры ртк', 'url' => '/site/volunteer_project'],
            ['label' => 'Киберспортивный клуб ртк', 'url' => '/site/cyber_project'],
          ],
        ],
        ['label' => 'Новости', 'url' => ['/post']],
        ['label' => 'Мероприятия', 'url' => ['/event']],
        ['label' => 'Контакты', 'url' => ['/site/contacts']],
        ['label' => 'Бюро находок', 'url' => ['/lost-property']],
      ]
    ]);

    if(Yii::$app->user->isGuest){
      echo "<div class='auth-link'>" . "<a href='/site/login'><img src=\"/web/img/login.svg\" alt=''></a>" . "</div>";
    }
    elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->isStudent) {
      echo "<div class='identity-icons'><div class='profile-link'><a href='/account'><img src=\"/web/img/profile.svg\" alt=''></a></div>
      <div class='auth-link'>" . Html::beginForm(['/site/logout'])
      . Html::submitButton(
        '<img src="/web/img/logout.svg" alt="">'

        )
        . Html::endForm() . "</div></div>";
      }
      elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->isManager) {
        echo "<div class='identity-icons'><div class='profile-link'><a href='/account/account/index2'><img src=\"/web/img/profile.svg\" alt=''></a></div>
        <div class='profile-link'><a href='/manager'><img src=\"/web/img/panel.svg\" alt=''></a></div>
        <div class='auth-link'>" . Html::beginForm(['/site/logout'])
        . Html::submitButton(
          '<img src="/web/img/logout.svg" alt="">'

          )
          . Html::endForm() . "</div></div>";
        }
        else{
          echo "<div class='identity-icons'><div class='profile-link'><a href='/admin'><img src=\"/web/img/panel.svg\" alt=''></a></div>
          <div class='auth-link'>" . Html::beginForm(['/site/logout'])
          . Html::submitButton(
            '<img src="/web/img/logout.svg" alt="">'

            )
            . Html::endForm() . "</div></div>";
          }
          NavBar::end();
          ?>
        </header>

        <main id="main" class="flex-shrink-0" role="main">
          <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
              <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
          </div>
        </main>

        <footer id="footer" class="mt-auto">
          <div class="container">
            <div class="footer__container">
              <div class="first-col"><a href='/'><img src='/web/img/logo.svg' alt=''></a>
                <p>Совет студенческого самоуправления<br> Радиотехнического колледжа</p>
              </div>
              <div class="second-col">
                <p>199155, г. Санкт-Петербург<br>
                  наб. реки Смоленки, д. 1</p>
                  <p>(812) 405-85-38</p>
                  <p>Info@spb-rtk.ru</p>
                </div>
                <div class="third-col"><a href='https://vk.com/studsovet.spbrtk'><img src='/web/img/vk.svg' alt=''></a></div>
                <div class="forth-col"><p>@ Все права защищены 2023</p></div>
              </div>
            </div>
          </footer>

          <?php $this->endBody() ?>
        </body>
        </html>
        <?php $this->endPage() ?>
