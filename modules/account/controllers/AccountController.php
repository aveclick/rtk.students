<?php

namespace app\modules\account\controllers;
use app\models\User;
use app\models\Event;
use app\models\Direction;
use app\models\Status;
use app\models\EventUser;
use app\models\ApplicationToCouncil;
use app\models\PasswordChangeForm;
use app\modules\account\models\UserSearch;
use app\modules\account\models\EventSearch;
use app\modules\account\models\ApplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

class AccountController extends Controller{
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
  * @return string
  */

  public function beforeAction($action){
    if (!parent::beforeAction($action)){
      return false;
    }

    if (Yii::$app->user->isGuest || Yii::$app->user->identity->isAdmin){
      return $this->goHome();
    }

    return true;
  }

  public function actionIndex()
  {
    $directions = Direction::getDirections();
    $statuses = Status::getStatuses();
    $searchModel1 = new UserSearch();
    $searchModel2 = new EventSearch();
    $searchModel3 = new ApplicationSearch();
    $dataProvider1 = $searchModel1->search($this->request->queryParams);
    $dataProvider2 = $searchModel2->search($this->request->queryParams);
    $dataProvider3 = $searchModel3->search($this->request->queryParams);
    return $this->render('index', [
      'searchModel1' => $searchModel1,
      'searchModel2' => $searchModel2,
      'searchModel3' => $searchModel3,
      'dataProvider1' => $dataProvider1,
      'dataProvider2' => $dataProvider2,
      'dataProvider3' => $dataProvider3,
      'directions' => $directions,
      'statuses' => $statuses,
    ]);
  }

  public function actionIndex2()
  {
    $searchModel1 = new UserSearch();
    $searchModel2 = new EventSearch();
    $dataProvider1 = $searchModel1->search($this->request->queryParams);
    $dataProvider2 = $searchModel2->search($this->request->queryParams);
    return $this->render('index2', [
      'searchModel1' => $searchModel1,
      'searchModel2' => $searchModel2,
      'dataProvider1' => $dataProvider1,
      'dataProvider2' => $dataProvider2,
    ]);
  }

  public function actionPasswordChange($id)
  {
      $user = $this->findModel($id);
      $model = new PasswordChangeForm($user);
      if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
          return $this->redirect(['index']);
      } else {
          return $this->render('passwordChange', [
              'model' => $model,
          ]);
      }
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      if (Yii::$app->user->identity->isManager){
        return $this->redirect(['index2']);
      }
      else{
        return $this->redirect(['index']);
      }
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  public function actionDeleteEvent($id)
  {
    $model = EventUser::find()
    ->where(['user_id' => Yii::$app->user->identity->getId()])
    ->andwhere(['id' => $id])
    ->one();
    $model->delete();
    if (Yii::$app->user->identity->isManager){
      return $this->redirect(['index2']);
    }
    else{
      return $this->redirect(['index']);
    }
  }

  public function actionDeleteApplication($id)
  {
    $model = ApplicationToCouncil::find()
    ->where(['user_id' => Yii::$app->user->identity->getId()])
    ->andwhere(['id' => $id])
    ->one();
    $model->delete();
    if (Yii::$app->user->identity->isManager){
      return $this->redirect(['index2']);
    }
    else{
      return $this->redirect(['index']);
    }
  }

  protected function findModel($id)
  {
    if (($model = User::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  protected function findModelEvent($id)
  {
    if (($model = EventUser::findOne(['user_id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
