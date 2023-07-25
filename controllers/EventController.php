<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Event;
use app\models\EventSearch;
use app\models\EventUser;
use app\models\Category;
use app\models\Direction;
use yii\filters\VerbFilter;


/**
* EventController implements the CRUD actions for Event model.
*/
class EventController extends Controller
{
  /**
  * @inheritDoc
  */
  public function behaviors()
  {
    return array_merge(
      parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  /**
  * Lists all Event models.
  *
  * @return string
  */
  public function actionIndex()
  {
    $searchModel = new EventSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    $categories = Category::getCategories();
    $directions = Direction::getDirections();
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'categories' => $categories,
      'directions' => $directions,
    ]);
  }

  /**
  * Displays a single Event model.
  * @param int $id ID
  * @return string
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
  * Creates a new Event model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return string|\yii\web\Response
  */
  public function actionCreate()
  {
    $categories = Category::getCategories();
    $directions = Direction::getDirections();
    $model = new Event();

    if ($this->request->isPost) {
      if ($model->load($this->request->post())) {
        $model->created_at = date("Y-m-d H:i:s");
        $model->direction_id = Yii::$app->user->identity->direction_id;
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->upload()) {
          // file is uploaded successfully
          $model->save(false);
          return $this->redirect(['index']);
        }
      }
    }   else {
      $model->loadDefaultValues();
    }
    return $this->render('create',
    [
      'model' => $model,
      'categories' => $categories,
      'directions' => $directions,
    ]);
  }

  public function actionAdd($id)
  {
    $model = $this->findModel($id);
    $event_user = new EventUser();
    $events = EventUser::getEvents($id, Yii::$app->user->identity->getId());
    if(empty($events)){
      $event_user->user_id = Yii::$app->user->identity->getId();
      $event_user->event_id = $model->id;
      $event_user->save();
      Yii::$app->session->setFlash('eventAddSubmitted');
    }
    else{
      Yii::$app->session->setFlash('eventAddNotSubmitted');
    }
    return $this->redirect(['index']);
  }

  /**
  * Updates an existing Event model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param int $id ID
  * @return string|\yii\web\Response
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
  * Deletes an existing Event model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param int $id ID
  * @return \yii\web\Response
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
  * Finds the Event model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param int $id ID
  * @return Event the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = Event::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
