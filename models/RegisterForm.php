<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $rules;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat'], 'string', 'max' => 255],
            ['email', 'email'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['rules', 'required', 'requiredValue' => 1, 'message' => 'Подтвердите согласие на обработку персональных данных'],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['name', 'surname'], 'match', 'pattern' => '/^[а-яёА-ЯЁ\s\-]+$/u', 'message' => 'Разрешенные символы: кириллица, пробел и тире'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/', 'message' => 'Разрешенные символы: латиница, цифры и тире'],
        ];
    }

    public function registerUser()
    {
        if ($this->validate()){
            $user = new User;
            if ($user->load($this->attributes, '')){
                $user->save(false);
            }
        }
        return $user ?? false;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'login' => 'Логин',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'password_repeat' => 'Подтвердите пароль',
            'rules' => 'Я согласен на обработку персональных данных',
        ];
    }
}
