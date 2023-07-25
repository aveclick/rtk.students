<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MailerForm extends Model
{
    public $subject;
    public $body;


    public function rules()
    {
        return [
            [['subject', 'body'], 'required'],
        ];
    }

        /* Определяем названия полей */
    public function attributeLabels()
    {
        return [
            'subject' => 'Тема',
            'body' => 'Сообщение',
        ];
    }

    public function sendEmail($emailto, $emailfrom)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose() 
                ->setFrom($emailfrom) /* от кого */
                ->setTo($emailto) /* куда */
                ->setSubject("От кого: " . Yii::$app->user->identity->email . " " . "Тема сообщения: " . $this->subject) /* имя отправителя */
                ->setTextBody($this->body) /* текст сообщения */
                ->send(); /* функция отправки письма */
            return true;
        } 
        else {
            return false;
        }
    }
}

