<?php

namespace app\modules\manager\controllers;

use app\models\Post;
use app\models\Category;
use app\models\Direction;
use app\modules\manager\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\web\UploadedFile;

/**
* Post_depController implements the CRUD actions for Post model.
*/
class PostController extends Controller
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
  * Lists all Post models.
  *
  * @return string
  */
  public function actionIndex()
  {
    $searchModel = new PostSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single Post model.
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
  * Creates a new Post model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return string|\yii\web\Response
  */
  public function actionCreate()
  {
    $categories = Category::getCategories();
    $directions = Direction::getDirections();
    $model = new Post();

    if ($model->load($this->request->post())) {
      $model->created_at = date("Y-m-d H:i:s");
      $model->direction_id = Yii::$app->user->identity->direction_id;
      $model->image = UploadedFile::getInstance($model, 'image');
      if (is_null($model->image)){
        $model->photo = '/upload/store/no-image.png';
      }
      $model->save();
      if ($model->image){
        $model->upload();
      }
      return $this->redirect(['index']);
    } else{
    return $this->render('create', [
      'model' => $model,
      'categories' => $categories,
      'directions' => $directions,
    ]);
  }
}


  /**
  * Updates an existing Post model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param int $id ID
  * @return string|\yii\web\Response
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $categories = Category::getCategories();
    if ($model->load($this->request->post())) {
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!is_null($model->image)){
        $model->removeImages();
      }
      $model->save();
      if ($model->image){
        $model->upload();
      }
      return $this->redirect(['index']);
    } else{
      return $this->render('update', [
        'model' => $model,
        'categories' => $categories,
      ]);
    }
  }

  /**
  * Deletes an existing Post model.
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
  * Finds the Post model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param int $id ID
  * @return Post the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = Post::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
