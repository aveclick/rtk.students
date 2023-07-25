<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $title
 *
 * @property ApplicationToCouncil[] $applicationToCouncils
 * @property ApplicationToEvent[] $applicationToEvents
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
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
        return $this->hasMany(ApplicationToCouncil::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[ApplicationToEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationToEvents()
    {
        return $this->hasMany(ApplicationToEvent::class, ['status_id' => 'id']);
    }
    
    public static function getStatuses(){
        return Status::find()  
        ->select('title')                      
        ->indexBy('id')
        ->column();
    }

    public static function getStatusId($status){
        return static::findOne(['title' => $status])->id;
    }
}
