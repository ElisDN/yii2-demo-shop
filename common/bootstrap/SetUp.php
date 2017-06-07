<?php

namespace common\bootstrap;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use League\Flysystem\Adapter\Ftp;
use League\Flysystem\Filesystem;
use shop\cart\Cart;
use shop\cart\cost\calculator\DynamicCost;
use shop\cart\cost\calculator\SimpleCost;
use shop\cart\storage\HybridStorage;
use shop\dispatchers\AsyncEventDispatcher;
use shop\dispatchers\DeferredEventDispatcher;
use shop\dispatchers\EventDispatcher;
use shop\dispatchers\SimpleEventDispatcher;
use shop\entities\behaviors\FlySystemImageUploadBehavior;
use shop\entities\Shop\Product\events\ProductAppearedInStock;
use shop\jobs\AsyncEventJobHandler;
use shop\listeners\Shop\Category\CategoryPersistenceListener;
use shop\listeners\Shop\Product\ProductAppearedInStockListener;
use shop\listeners\Shop\Product\ProductSearchPersistListener;
use shop\listeners\Shop\Product\ProductSearchRemoveListener;
use shop\listeners\User\UserSignupConfirmedListener;
use shop\listeners\User\UserSignupRequestedListener;
use shop\repositories\events\EntityPersisted;
use shop\repositories\events\EntityRemoved;
use shop\services\newsletter\MailChimp;
use shop\services\newsletter\Newsletter;
use shop\services\sms\LoggedSender;
use shop\services\sms\SmsRu;
use shop\services\sms\SmsSender;
use shop\services\yandex\ShopInfo;
use shop\services\yandex\YandexMarket;
use shop\entities\User\events\UserSignUpConfirmed;
use shop\entities\User\events\UserSignUpRequested;
use shop\useCases\ContactService;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\caching\Cache;
use yii\di\Container;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;
use yii\queue\Queue;
use yiidreamteam\upload\ImageUploadBehavior;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ErrorHandler::class, function () use ($app) {
            return $app->errorHandler;
        });

        $container->setSingleton(Queue::class, function () use ($app) {
            return $app->get('queue');
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        $container->setSingleton(YandexMarket::class, [], [
            new ShopInfo($app->name, $app->name, $app->params['frontendHostInfo']),
        ]);

        $container->setSingleton(Newsletter::class, function () use ($app) {
            return new MailChimp(
                new \DrewM\MailChimp\MailChimp($app->params['mailChimpKey']),
                $app->params['mailChimpListId']
            );
        });

        $container->setSingleton(SmsSender::class, function () use ($app) {
            return new LoggedSender(
                new SmsRu($app->params['smsRuKey']),
                \Yii::getLogger()
            );
        });

        $container->setSingleton(EventDispatcher::class, DeferredEventDispatcher::class);

        $container->setSingleton(DeferredEventDispatcher::class, function (Container $container) {
            return new DeferredEventDispatcher(new AsyncEventDispatcher($container->get(Queue::class)));
        });

        $container->setSingleton(SimpleEventDispatcher::class, function (Container $container) {
            return new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
                ProductAppearedInStock::class => [ProductAppearedInStockListener::class],
                EntityPersisted::class => [
                    ProductSearchPersistListener::class,
                    CategoryPersistenceListener::class,
                ],
                EntityRemoved::class => [
                    ProductSearchRemoveListener::class,
                    CategoryPersistenceListener::class,
                ],
            ]);
        });

        $container->setSingleton(AsyncEventJobHandler::class, [], [
            Instance::of(SimpleEventDispatcher::class)
        ]);

        /*
        $container->setSingleton(Filesystem::class, function () use ($app) {
            return new Filesystem(new Ftp($app->params['ftp']));
        });

        $container->set(ImageUploadBehavior::class, FlySystemImageUploadBehavior::class);
        */
    }
}