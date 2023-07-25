<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property string $title
 *
 * @property ApplicationToCouncil[] $applicationToCouncils
 * @property Event[] $events
 * @property Post[] $posts
 * @property User[] $users
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ApplicationToCouncils]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationToCouncils()
    {
        return $this->hasMany(ApplicationToCouncil::class, ['direction_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['direction_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['direction_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['direction_id' => 'id']);
    }

    public static function getDirections(){
        return Direction::find()
        ->select('title')
        ->indexBy('id')
        ->column();
    }

    public static function getDirectionId($direction){
        return static::findOne(['title' => $direction])->id;
    }
}
