<?php

namespace shop\forms\manage\User;

use shop\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $role;

    public function rules(): array
    {
        return [
            [['username', 'email', 'phone', 'role'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email', 'phone'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
            ['phone', 'integer'],
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }
}