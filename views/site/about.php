<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;
use yii\helpers\StringHelper;
use app\models\Post;
$this->title = 'Главная страница';
?>
<div class="main-page">
  <div class="main-section">
    <div class="main-section__img">
      <img src='/web/img/main-screen.jpg' alt='Совет студенческого самоуправления'>
    </div>
    <div class="main-wrapper">
      <div class="main-section__content">
        <div class="main-section__topic">
          <h1>Совет студенческого самоуправления радиотехнического колледжа</h1>
        </div>
        <div class="main-section__btn">
          <a href="#about" class="btn">О нас</a>
        </div>
      </div>
    </div>
  </div>
  <div class="about-section" id="about">
    <div class="section-wrapper">
      <div class="about-section__title">
        <h2>О нас</h2>
      </div>
      <div class="about-section__container">
        <div class="about-section__content">
          <div class="about-section__text">
            <p>Студенческое самоуправление — одна из форм воспитательной работы колледжа, осуществляемая в рамках концепции
            непрерывного образования, направленная на формирование всесторонне развитой, творческой личности, с активной жизненной позицией,
            подготовку современных специалистов, конкурентоспособных на рынке труда.</p>
            <p>В Радиотехническом колледже функционирует Студенческий совет самоуправления, который создан в целях обеспечения
            реализации прав обучающихся на участие в управлении образовательным процессом, решения важных вопросов жизнедеятельности студенческой молодежи,
            развития ее социальной активности, поддержки и реализации социальных инициатив.</p>
            <p>Деятельность Совета направлена на формирование активной гражданской позиции обучающихся, содействие развитию их
            самостоятельности, способности к самоорганизации и саморазвитию, формирование умений и навыков самоуправления, подготовка к компетентному и
            ответственному участию в жизни общества.</p>
          </div>
        </div>
        <div class="about-section__img">
          <img src='/web/img/main-about.jpg' alt='Совет студенческого самоуправления'>
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
                Председатель ССС и руководитель проекта «Волонтеры РТК»
              </div>
            </div>
        </div>
        <div class="new-string"></div>
        <div class="item">
          <img src="/web/img/team-2.png" alt="Алексей Громов">
          <div class="item__content">
            <div class="item__title">
              Алексей Громов
            </div>
            <div class="item__text">
              Руководитель Профессионально-ориентирующего отдела
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/web/img/team-3.png" alt="Михаил Кудров">
          <div class="item__content">
            <div class="item__title">
              Михаил Кудров
            </div>
            <div class="item__text">
              Руководитель<br> Учебного отдела
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/web/img/team-4.png" alt="Анна Голубева">
          <div class="item__content">
            <div class="item__title">
              Анна Голубева
            </div>
            <div class="item__text">
              Руководитель Культурно-творческого отдела
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/web/img/team-5.png" alt="Дмитрий Сараев">
          <div class="item__content">
            <div class="item__title">
              Дмитрий Сараев
            </div>
            <div class="item__text">
              Руководитель Физкультурно-оздоровительного отдела
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/web/img/team-6.png" alt="Асхат Тахаутдинов">
          <div class="item__content">
            <div class="item__title">
              Асхат Тахаутдинов
            </div>
            <div class="item__text">
              Руководитель Гражданско-патриотического отдела
            </div>
          </div>
        </div>
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
        <div class="item">
          <img src="/web/img/team-8.png" alt="Павел Падалкин">
          <div class="item__content">
            <div class="item__title">
              Павел Падалкин
            </div>
            <div class="item__text">
              Руководитель мультимедийного центра «ЖиМ»
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/web/img/team-9.png" alt="Кирилл Мокрушин">
          <div class="item__content">
            <div class="item__title">
              Кирилл Мокрушин
            </div>
            <div class="item__text">
              Руководитель Киберспортивного клуба
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
          foreach($posts as $post){
            $model = Post::findOne(['id' => $post["id"]]);
            echo "<div class='col'>
            <div class='card'>" .
            Html::img($model->getImage()->getUrl(), ['class' => 'card-img-top', 'alt' => $model->title]) .
            "<div class='card-body'>
            <h5 class='card-title'>".Html::a(Html::encode($post["title"]), ['/post/view', 'id' => $post["id"]]) . "</h5>" .
            "<div class='card-text'>" . StringHelper::truncateWords((strip_tags($post["text"])), 24, ' ...') . "</div>
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
  <div class="fqa-section">
    <div class="section-wrapper">
      <div class="fqa-section__title">
        <h2>Частые вопросы</h2>
      </div>
      <div class="fqa-section__content">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Какие обязанности у студсовета?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Развитие и закрепление традиций студенческой жизни колледжа и укрепление его репутации,
                поддержка реализации общественно значимых молодежных инициатив, организация и осуществление контроля культурно-массовых,
                досуговых и спортивных мероприятий и т.д.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Какие преимущества дает вступление в студсовет?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Вступление в студсовет позволит студенту принимать непосредственное участие в общественной жизни колледжа,
              получить опыт организаторской деятельности, раскрыть свой творческий потенциал, завести полезные знакомства, получить навыки работы в команде
              и многое другое! </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Какие направления есть в студсовете?
              </button>
            </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">В состав студсовета входят 6 отделов: профессионально-ориентирующий, учебный, культурно-творческий, физкультурно-оздоровительный, гражданско-патриотический и
              экологический, а также 3 проекта: мультимедийный центр «ЖиМ», волонтеры РТК и Киберспортивный клуб РТК.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                  Что нужно для вступления в студсовет?
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Для вступления в студсовет студенту требуется наличие желания улучшить социальную жизнь учащихся нашего колледжа!</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
