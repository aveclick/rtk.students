<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lost_item".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string|null $photo
 * @property int $presence_indicator
 * @property int $user_id
 * @property string $created_at
 *
 * @property User $user
 */
class LostItem extends \yii\db\ActiveRecord
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
        return 'lost_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'presence_indicator', 'user_id', 'created_at'], 'required'],
            [['text'], 'string'],
            [['presence_indicator', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'photo'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 255, 'message' => 'Максимальное количество символов: 255'],
            [['rules'], 'boolean'],
            ['rules', 'safe'],
            // [['rules'], 'default', 'value' => false],
            // ['rules', 'required', 'requiredValue' => 1, 'message' => 'Подтвердите согласие на обработку персональных данных'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => 'Название',
            'text' => 'Описание',
            'photo' => 'Фото',
            'presence_indicator' => 'Категория',
            'user_id' => 'User ID',
            'created_at' => 'Дата публикации',
            'rules' => 'Не показывать мой эл. адрес',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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

    public function getRequirements()
    {
      return $this->rules;
    }

    public function setRequirements($rules)
    {
    /**
     * Здесь в приватном свойстве requirements после load будет хранится массив
     */
    $this->rules = $rules;
    }
}
