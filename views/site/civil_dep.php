<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Гражданско-патриотический отдел';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/civilpatriotic_dep-screen.jpg' alt='Волонтеры РТК'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Гражданско-патриотический отдел Радиотехнического колледжа</h1>
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
            <p>Гражданско-патриотический отдел – это один из отделов Совета студенческого самоуправления.</p>
            <p>Гражданско-патриотический отдел выполняет такие задачи, как: патриотическое воспитание молодежи,
            продвижение гражданских ценностей, просветительская деятельность в области военной истории.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/civilpatriotic_dep-about.jpg' alt='Гражданско-патриотический отдел'>
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
          <img src="/web/img/team-6.png" alt="Асхат Тахаутдинов">
          <div class="item__content">
            <div class="item__title">
              Асхат Тахаутдинов
            </div>
            <div class="item__text">
              Руководитель<br> Гражданско-патриотического отдела
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-14.png" alt="Илья Арабов">
          <div class="item__content">
            <div class="item__title">
              Илья Арабов
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Гражданско-патриотического отдела
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
          foreach($civil_posts as $civil_post){
            $model = Post::findOne(['id' => $civil_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($civil_post["title"]), ['/post/view', 'id' => $civil_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($civil_post["text"])), 24, ' ...') . "</div>
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
