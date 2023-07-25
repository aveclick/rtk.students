<?php

namespace app\modules\manager\controllers;

use app\models\ApplicationToCouncil;
use app\models\Direction;
use app\models\Status;
use app\modules\manager\models\ManagerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
* ManagerController implements the CRUD actions for ApplicationToCouncil model.
*/
class ManagerController extends Controller
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

  public function beforeAction($action){
    if (!parent::beforeAction($action)){
      return false;
    }

    if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isManager){
      return $this->goHome();
    }

    return true;
  }

  /**
  * Lists all ApplicationToCouncil models.
  *
  * @return string
  */
  public function actionIndex()
  {
    $searchModel = new ManagerSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    $directions = Direction::getDirections();
    $statuses = Status::getStatuses();
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'directions' => $directions,
      'statuses' => $statuses,
    ]);
  }

  /**
  * Displays a single ApplicationToCouncil model.
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
  * Creates a new ApplicationToCouncil model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return string|\yii\web\Response
  */
  public function actionCreate()
  {
    $model = new ApplicationToCouncil();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
  * Updates an existing ApplicationToCouncil model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param int $id ID
  * @return string|\yii\web\Response
  * @throws NotFoundHttpException if the model cannot be found
  */

  public function actionConfirm($id)
  {
    $model = $this->findModel($id);
    $model->scenario = ApplicationToCouncil::SCENARIO_DENY;
    if ($this->request->isPost && $model->load($this->request->post())) {
      $model->status_id = Status::getStatusId('Подтвержденная');
      $model->save();
      return $this->redirect('index');
    }

    return $this->render('apply', [
      'model' => $model,
    ]);
  }


  public function actionCancel($id)
  {
    $model = $this->findModel($id);
    $model->scenario = ApplicationToCouncil::SCENARIO_DENY;
    if ($this->request->isPost && $model->load($this->request->post())) {
      $model->status_id = Status::getStatusId('Отмененная');
      $model->save();
      return $this->redirect('index');
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
  * Deletes an existing ApplicationToCouncil model.
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
  * Finds the ApplicationToCouncil model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param int $id ID
  * @return ApplicationToCouncil the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = ApplicationToCouncil::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
