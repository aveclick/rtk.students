<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Волонтеры РТК';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/volunteer_project-screen.jpg' alt='Волонтеры РТК'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Волонтеры РТК</h1>
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
            <p>Волонтеры РТК – это один из проектов Совета студенческого самоуправления.</p>
            <p>Волонтеры РТК – добровольческое движение в Радиотехническом колледже, помогающее в организации и проведении
            мероприятий, как внутри нашего колледжа, так и за его пределами.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/volunteer_project-about.jpg' alt='Волонтеры РТК'>
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
          <img src="/web/img/team-1.png" alt="Николай Кущев">
          <div class="item__content">
            <div class="item__title">
              Николай Кущев
            </div>
            <div class="item__text">
              Руководитель<br> проекта «Волонтеры РТК»
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-17.png" alt="Имя Фамилия">
          <div class="item__content">
            <div class="item__title">
              Анастасия Шарова
            </div>
            <div class="item__text">
              Заместитель руководителя<br> проекта «Волонтеры РТК»
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
          foreach($volunteer_posts as $volunteer_post){
            $model = Post::findOne(['id' => $volunteer_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($volunteer_post["title"]), ['/post/view', 'id' => $volunteer_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($volunteer_post["text"])), 24, ' ...') . "</div>
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
