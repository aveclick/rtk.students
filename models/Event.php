<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "event".
*
* @property int $id
* @property string $title
* @property string $text
* @property string $photo
* @property int $category_id
* @property int|null $direction_id
* @property string $date
* @property string $created_at
*
* @property ApplicationToEvent[] $applicationToEvents
* @property Category $category
* @property Direction $direction
*/
class Event extends \yii\db\ActiveRecord
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
    return 'event';
  }

  /**
  * {@inheritdoc}
  */
  public function rules()
  {
    return [
      [['title', 'text', 'category_id', 'direction_id', 'date'], 'required'],
      [['text'], 'string'],
      ['text', 'trim'],
      [['category_id', 'direction_id'], 'integer'],
      [['date', 'created_at'], 'safe'],
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
      'date' => 'Дата проведения',
      'created_at' => 'Дата публикации',
    ];
  }

  /**
  * Gets query for [[ApplicationToEvents]].
  *
  * @return \yii\db\ActiveQuery
  */
  public function getApplicationToEvents()
  {
    return $this->hasMany(ApplicationToEvent::class, ['event_id' => 'id']);
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
