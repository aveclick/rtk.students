<?php
/** @var yii\web\View $this */
use yii\helpers\StringHelper;
use yii\bootstrap5\Html;
use app\models\Post;
$this->title = 'Киберспортивный клуб РТК';
?>
<div class="dep-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/cybersport_project-screen.jpg' alt='Киберспортивный клуб РТК'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Киберспортивный клуб РТК</h1>
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
            <p>Киберспортивный клуб РТК – это один из проектов Совета студенческого самоуправления.</p>
            <p>Киберспортивный клуб РТК – проект Радиотехнического колледжа,
            организовывающий внутренние турниры по различным дисциплинам, для отбора сильной команды. Участвует в турнирах между СПО и ВУЗами.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/cybersport_project-about.jpg' alt='Киберспортивный клуб РТК'>
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
          <img src="/web/img/team-9.png" alt="Кирилл Мокрушин">
          <div class="item__content">
            <div class="item__title">
              Кирилл Мокрушин
            </div>
            <div class="item__text">
              Руководитель<br> Киберспортивного клуба
            </div>
          </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-18.png" alt="Имя Фамилия">
          <div class="item__content">
            <div class="item__title">
              Никита Беляев
            </div>
            <div class="item__text">
              Заместитель руководителя<br> Киберспортивного клуба
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
          foreach($cyber_posts as $cyber_post){
            $model = Post::findOne(['id' => $cyber_post["id"]]);
            echo "<div class='col'>
            <div class='card'>"
            . Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($cyber_post["title"]), ['/post/view', 'id' => $cyber_post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($cyber_post["text"])), 24, ' ...') . "</div>
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
