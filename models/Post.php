<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "post".
*
* @property int $id
* @property string $title
* @property string $text
* @property string $photo
* @property int $category_id
* @property int|null $direction_id
* @property string $created_at
*
* @property Category $category
* @property Direction $direction
*/
class Post extends \yii\db\ActiveRecord
{
  public $image;

  public function behaviors()
  {
    return [
      'image' => [
        'class' => 'rico\yii2images\behaviors\ImageBehave',
      ]
    ];
  }

  /**
  * {@inheritdoc}
  */
  public static function tableName()
  {
    return 'post';
  }

  /**
  * {@inheritdoc}
  */
  public function rules()
  {
    return [
      [['title', 'text', 'category_id', 'direction_id'], 'required'],
      [['text'], 'string'],
      ['text', 'trim'],
      [['category_id', 'direction_id'], 'integer'],
      [['created_at'], 'safe'],
      [['title', 'photo'], 'string', 'max' => 255],
      [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
      [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::class, 'targetAttribute' => ['direction_id' => 'id']],
      [['image'], 'file', 'extensions' => 'png, jpg'],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => 'Заголовок',
      'text' => 'Текст',
      'photo' => 'Фото',
      'category_id' => 'Категория',
      'direction_id' => 'Направление',
      'created_at' => 'Дата публикации',
    ];
  }

  /**
  * Gets query for [[Category]].
  *
  * @return \yii\db\ActiveQuery
  */
  public function getCategory()
  {
    return $this->hasOne(Category::class, ['id' => 'category_id']);
  }

  /**
  * Gets query for [[Direction]].
  *
  * @return \yii\db\ActiveQuery
  */
  public function getDirection()
  {
    return $this->hasOne(Direction::class, ['id' => 'direction_id']);
  }

  public static function getPosts(){
    return Post::find()
    ->orderBy('created_at DESC')
    ->limit(3)
    ->asArray()
    ->all();
  }

  public function upload()
  {
    if ($this->validate()) {
      $path = 'upload/store/' . $this->image->baseName. '.' . $this->image->extension;
      $this->image->saveAs($path);
      $this->attachImage($path);
      @unlink($path);
      return true;
    } else {
      return false;
    }
  }
}
