<?php

namespace shop\jobs\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use shop\repositories\UserRepository;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;
use yii\queue\Job;

class ProductAvailabilityNotification implements Job
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function execute($queue): void
    {
        foreach ($this->getUsers()->getAllByProductInWishList($this->product->id) as $user) {
            if ($user->isActive()) {
                try {
                    $this->sendEmailNotification($user, $this->product);
                } catch (\Exception $e) {
                    $this->getErrorHandler()->handleException($e);
                }
            }
        }
    }

    private function sendEmailNotification(User $user, Product $product): void
    {
        $sent = $this->getMailer()
            ->compose(
                ['html' => 'shop/wishlist/available-html', 'text' => 'shop/wishlist/available-text'],
                ['user' => $user, 'product' => $product]
            )
            ->setTo($user->email)
            ->setSubject('Product is available')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error to ' . $user->email);
        }
    }

    private function getUsers(): UserRepository
    {
        return \Yii::$container->get(UserRepository::class);
    }

    private function getMailer(): MailerInterface
    {
        return \Yii::$container->get(MailerInterface::class);
    }

    private function getErrorHandler(): ErrorHandler
    {
        return \Yii::$container->get(ErrorHandler::class);
    }
}