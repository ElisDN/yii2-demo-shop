<?php

namespace common\bootstrap;

use frontend\services\auth\UserPasswordResetService;
use frontend\services\contact\ContactService;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(UserPasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
        ]);

        $container->setSingleton(ContactService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
            $app->params['adminEmail']
        ]);
    }
}