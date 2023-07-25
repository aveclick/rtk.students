<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Экологический отдел';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/eco_dep-screen.jpg' alt='Экологический отдел'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Экологический отдел Радиотехнического колледжа</h1>
        </div>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isStudent): ?>
          <div class="main-section__btn">
            <?= Html::a('ОСТАВИТЬ ЗАЯВКУ', ['/application/create', 'id' => $model->id], ['class' => 'btn']) ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="about-section">
    <div class="section-wrapper">
      <div class="about-section__title">
        <h2>О нас</h2>
      </div>
      <div class="about-section__container">
        <div class="about-section__content">
          <div class="about-section__text">
            <p>Экологический отдел – это своеобразный «зелёный» уголок нашего колледжа, который личным примером своей деятельности
            старается приобщать студентов бережно относиться к окружающему миру.</p>
            <p>Мы проводим информационные мини-уроки для обучающихся, представляем Радиотехнический колледж на городских конкурсах
            и мероприятиях.</p>
            <p>Наша команда всегда готова к диалогу через совместные игры, собрания и экологически-полезные «походы в город».</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/eco_dep-about.jpg' alt='Экологический отдел'>
        </div>
      </div>
    </div>
  </div>
  <div class="team-section">
    <div class="section-wrapper">
      <div class="team-section__title">
        <h2>Наша команда</h2>
      </div>
      <div class="team-section__items">
        <div class="item">
          <img src="/web/img/team-7.png" alt="Виталий Скородумов">
          <div class="item__content">
            <div class="item__title">
              Виталий Скородумов
            </div>
            <div class="item__text">
              Руководитель<br> Экологического отдела
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-10.png" alt="Тая Глава">
          <div class="item__content">
            <div class="item__title">
              Тая Глава
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Экологического отдела
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="news-section">
    <div class="section-wrapper">
      <div class="news-section_title">
        <h2>Наши новости</h2>
      </div>
      <div class="news-section__content">
        <div class="news-section__cards row row-cols-1 row-cols-md-3 g-4">
          <?php
          foreach($eco_posts as $eco_post){
            $model = Post::findOne(['id' => $eco_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($eco_post["title"]), ['/post/view', 'id' => $eco_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($eco_post["text"])), 24, ' ...') . "</div>
            </div>
            </div>
            </div>";
          }
          ?>
        </div>
        <div class="news-section__btn">
          <a href="/post" class="btn">Все новости</a>
        </div>
      </div>
    </div>
  </div>
</div>
