<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Культурно-творческий отдел';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/culturalcreative_dep-screen.jpg' alt='Культурно-творческий отдел'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Культурно-творческий отдел Радиотехнического колледжа</h1>
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
            <p>	Культурно-творческий отдел – это отдел, занимающиеся организацией, подготовкой и
            проведением культурно-массовых мероприятий.</p>
            <p>Целью работы отдела является развитие и
            стимулирование студенческой художественной самодеятельности, создание условий для творческой
            самореализации через культурно-массовую работу.</p>
            <p>Отдел занимается проведением мероприятий согласно
            воспитательному плану, участием в городских и всероссийских конкурсах, созданием новых форматов мероприятий,
            проведением творческих конкурсов и кастингов.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/culturalcreative_dep-about.jpg' alt='Культурно-творческий отдел'>
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
          <img src="/web/img/team-4.png" alt="Анна Голубева">
          <div class="item__content">
            <div class="item__title">
              Анна Голубева
            </div>
            <div class="item__text">
              Руководитель<br> Культурно-творческого отдела
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-12.png" alt="Никита Сергеев">
          <div class="item__content">
            <div class="item__title">
              Никита Сергеев
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Культурно-творческого отдела
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
          foreach($cultural_posts as $cultural_post){
            $model = Post::findOne(['id' => $cultural_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($cultural_post["title"]), ['/post/view', 'id' => $cultural_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($cultural_post["text"])), 24, ' ...') . "</div>
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
