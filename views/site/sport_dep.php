<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Физкультурно-оздоровительный отдел';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/sporthealth_dep-screen.jpg' alt='Физкультурно-оздоровительный отдел'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Физкультурно-оздоровительный отдел Радиотехнического колледжа</h1>
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
            <p>Физкультурно-оздоровительный отдел – это один из отделов Студенческого совета самоуправления.</p>
            <p>Физкультурно-оздоровительный отдел занимается физической культурой и оздоровительными
            мероприятиями для укрепления здоровья и развитием спортивных навыков у обучающихся колледжа. </p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/sporthealth_dep-about.jpg' alt='Физкультурно-оздоровительный отдел'>
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
          <img src="/web/img/team-5.png" alt="Дмитрий Сараев">
          <div class="item__content">
            <div class="item__title">
              Дмитрий Сараев
            </div>
            <div class="item__text">
              Руководитель<br> Физкультурно-оздоровительного отдела
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-13.png" alt="Артем Любушкин">
          <div class="item__content">
            <div class="item__title">
              Артем Любушкин
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Физкультурно-оздоровительного отдела
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
          foreach($sport_posts as $sport_post){
            $model = Post::findOne(['id' => $sport_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($sport_post["title"]), ['/post/view', 'id' => $sport_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($sport_post["text"])), 24, ' ...') . "</div>
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
