<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_to_council".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property int $direction_id
 * @property string $created_at
 * @property string|null $reason
 *
 * @property Direction $direction
 * @property Status $status
 * @property User $user
 */
class ApplicationToCouncil extends \yii\db\ActiveRecord
{
    const SCENARIO_DENY = 'deny';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application_to_council';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id', 'direction_id'], 'required'],
            [['user_id', 'status_id', 'direction_id'], 'integer'],
            [['created_at'], 'safe'],
            [['reason'], 'string', 'max' => 255],
            [['reason'], 'required', 'on' => static::SCENARIO_DENY],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::class, 'targetAttribute' => ['direction_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'direction_id' => 'Направление',
            'created_at' => 'Created At',
            'reason' => 'Примечание',
        ];
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

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
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

    public static function getApplications($id){
        return static::find()
        ->where(['user_id' => $id])
        ->asArray()
        ->all();
    }
}
