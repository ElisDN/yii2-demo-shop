<?php

namespace common\bootstrap;

use frontend\services\auth\UserPasswordResetService;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(UserPasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
        ]);
    }
}