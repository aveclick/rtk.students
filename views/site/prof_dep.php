<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Профессионально-ориентирующий отдел';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/prof_dep-screen.jpg' alt='Профессионально-ориентирующий отдел'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Профессионально-ориентирующий отдел Радиотехнического колледжа</h1>
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
            <p>Профессионально-ориентирующий отдел – это один из отделов Совета студенческого самоуправления, выполняющий
            важную роль в общественной жизни Радиотехнического колледжа.</p>
            <p>Этот отдел занимается организацией и проведением дней открытых дверей для
            абитуриентов, профессионально-агитационной деятельностью в школах и консультациями по наилучшему выбору
            профессии на базе нашего колледжа.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/prof_dep-about.jpg' alt='Профессионально-ориентирующий отдел'>
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
          <img src="/web/img/team-2.png" alt="Алексей Громов">
          <div class="item__content">
            <div class="item__title">
              Алексей Громов
            </div>
            <div class="item__text">
              Руководитель<br> Профессионально-ориентирующего отдела
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-16.png" alt="Имя Фамилия">
          <div class="item__content">
            <div class="item__title">
              Анастасия Тобольшина
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Профессионально-ориентирующего отдела
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
          foreach($prof_posts as $prof_post){
            $model = Post::findOne(['id' => $prof_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($prof_post["title"]), ['/post/view', 'id' => $prof_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($prof_post["text"])), 24, ' ...') . "</div>
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
