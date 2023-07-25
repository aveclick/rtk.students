<?php

namespace app\controllers;

use yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Request;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Post;
use app\models\Direction;
use app\models\MailerForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
  /**
  * {@inheritdoc}
  */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  /**
  * Displays homepage.
  *
  * @return string
  */
  public function actionIndex()
  {
    return $this->render('index');
  }

  /**
  * Login action.
  *
  * @return Response|string
  */
  public function actionLogin()
  {
    $this->layout = 'main2';
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
  * Logout action.
  *
  * @return Response
  */
  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
  * Displays contact page.
  *
  * @return Response|string
  */
  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
  * Displays about page.
  *
  * @return string
  */
  public function actionAbout()
  {
    $posts = Post::getPosts();
    return $this->render('about', [
      'posts' => $posts,
    ]);
  }

  public function actionRegister()
  {
    $this->layout = 'main2';
    $model = new RegisterForm();

    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }

    if ($model->load(Yii::$app->request->post())) {
      if ($user = $model->registerUser()){
        Yii::$app->user->login($user);
        return $this->redirect('/');
      }
    }
    return $this->render('register', compact('model'));
  }

  public function actionProf_dep()
  {
    $prof_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Профессионально-ориентирующий отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('prof_dep', compact('prof_posts'));
  }

  public function actionTraining_dep()
  {
    $training_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Учебный отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('training_dep', compact('training_posts'));
  }

  public function actionCultural_dep()
  {
    $cultural_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Культурно-творческий отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('cultural_dep', compact('cultural_posts'));
  }

  public function actionSport_dep()
  {
    $sport_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Физкультурно-оздоровительный отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('sport_dep', compact('sport_posts'));
  }

  public function actionCivil_dep()
  {
    $civil_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Гражданско-патриотический отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('civil_dep', compact('civil_posts'));
  }

  public function actionEco_dep()
  {
    $eco_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Экологический отдел')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('eco_dep', compact('eco_posts'));
  }

  public function actionMedia_project()
  {
    $media_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Мультимедийный центр «ЖиМ»')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('media_project', compact('media_posts'));
  }

  public function actionVolunteer_project()
  {
    $volunteer_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Волонтеры РТК')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('volunteer_project', compact('volunteer_posts'));
  }

  public function actionCyber_project()
  {
    $cyber_posts = Post::find()
    ->where(['direction_id' => Direction::getDirectionId('Киберспортивный клуб РТК')])
    ->orderBy('id DESC')
    ->limit(3)
    ->asArray()
    ->all();
    return $this->render('cyber_project', compact('cyber_posts'));
  }

  public function actionContacts()
  {
    /* создаем экземпляр класса */
    $model = new MailerForm();
    /* получаем данные из формы и запускаем функцию отправки сообщения на почту */
    if ($model->load(Yii::$app->request->post()) && $model->sendEmail(Yii::$app->params['emailto'], (Yii::$app->params['emailfrom']))) {
      Yii::$app->session->setFlash('contactFormSubmitted');
      return $this->refresh();
      /* иначе выводим форму обратной связи */
    } else {
      return $this->render('contacts', [
        'model' => $model,
      ]);
    }
  }
}
