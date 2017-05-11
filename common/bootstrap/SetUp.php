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

        $container->setSingleton(UserPasswordResetService::class);

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);
    }
}