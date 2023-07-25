<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\LostItem;
use app\models\LostPropertySearch;
use app\models\Role;
use yii\filters\VerbFilter;

/**
* LostPropertyController implements the CRUD actions for LostItem model.
*/
class LostPropertyController extends Controller
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
  * Lists all LostItem models.
  *
  * @return string
  */
  public function actionIndex()
  {
    $searchModel = new LostPropertySearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    $roles = Role::getRoles();
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'roles' => $roles,
    ]);
  }

  /**
  * Displays a single LostItem model.
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
  * Creates a new LostItem model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return string|\yii\web\Response
  */
  public function actionCreate()
  {
    $model = new LostItem();

    if ($model->load($this->request->post())) {
      $model->user_id = Yii::$app->user->identity->getId();
      $model->created_at = date("Y-m-d H:i:s");
      $model->rules = $model->getRequirements();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (is_null($model->image)){
        $model->photo = '/upload/store/no-image.png';
      }
      $model->save();
      if ($model->image){
        $model->upload();
      }
      return $this->redirect(['index']);
    } else {
      return $this->render('create', [
        'model' => $model,
      ]);
    }
  }

  /**
  * Updates an existing LostItem model.
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
  * Deletes an existing LostItem model.
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
  * Finds the LostItem model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param int $id ID
  * @return LostItem the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = LostItem::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
