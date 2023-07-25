<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\ApplicationToCouncil;
use app\models\ApplicationSearch;
use app\models\Status;
use app\models\Direction;
use yii\filters\VerbFilter;

/**
* ApplicationController implements the CRUD actions for ApplicationToCouncil model.
*/
class ApplicationController extends Controller
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
  * Lists all ApplicationToCouncil models.
  *
  * @return string
  */
  public function actionIndex()
  {
    $searchModel = new ApplicationSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
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
    $directions = Direction::getDirections();
    if ($this->request->isPost) {
      if ($model->load($this->request->post())) {
        $model->user_id = Yii::$app->user->identity->getId();
        $model->created_at = date("Y-m-d H:i:s");
        $model->status_id = Status::getStatusId('Новая');
        $model->save();
        return $this->redirect('/');
      }
    }

    return $this->render('create', [
      'model' => $model,
      'directions' => $directions,
    ]);
  }

  /**
  * Updates an existing ApplicationToCouncil model.
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
