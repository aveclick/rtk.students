<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property int $role_id
 * @property int|null $direction_id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $auth_key
 *
 * @property ApplicationToCouncil[] $applicationToCouncils
 * @property ApplicationToEvent[] $applicationToEvents
 * @property Direction $direction
 * @property LostItem[] $lostItems
 * @property Role $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_DENY = 'deny';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'role_id', 'login', 'email', 'password', 'auth_key'], 'required'],
            [['direction_id'], 'required', 'on' => static::SCENARIO_DENY],
            [['role_id', 'direction_id'], 'integer'],
            [['name', 'surname', 'login', 'email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['email', 'login'], 'unique', 'targetAttribute' => ['email', 'login']],
            ['email', 'email'],
            [['name', 'surname'], 'match', 'pattern' => '/^[а-яёА-ЯЁ\s\-]+$/u', 'message' => 'Разрешенные символы: кириллица, пробел и тире'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/', 'message' => 'Разрешенные символы: латиница, цифры и тире'],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::class, 'targetAttribute' => ['direction_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'role_id' => 'Role ID',
            'direction_id' => 'Направление',
            'login' => 'Логин',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[ApplicationToCouncils]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationToCouncils()
    {
        return $this->hasMany(ApplicationToCouncil::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ApplicationToEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationToEvents()
    {
        return $this->hasMany(ApplicationToEvent::class, ['user_id' => 'id']);
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
     * Gets query for [[LostItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLostItems()
    {
        return $this->hasMany(LostItem::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
        public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findByUsername($login){
        return static::findOne(['login' => $login]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                $this->role_id = Role::getRoleId('Студент');
            }
            return true;
        }
        return false;
    }

    public function getIsAdmin(){
        return $this->role_id == Role::getRoleId('Администратор');
    }

    public function getIsManager(){
        return $this->role_id == Role::getRoleId('Менеджер');
    }

    public function getIsStudent(){
        return $this->role_id == Role::getRoleId('Студент');
    }
}
