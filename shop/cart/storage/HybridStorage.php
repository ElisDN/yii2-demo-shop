<?php

namespace shop\cart\storage;

use shop\cart\CartItem;
use yii\db\Connection;
use yii\web\Session;
use yii\web\User;

class HybridStorage implements StorageInterface
{
    private $storage;
    private $user;
    private $cookieKey;
    private $cookieTimeout;
    private $db;

    public function __construct(User $user, $cookieKey, $cookieTimeout, Connection $db)
    {
        $this->user = $user;
        $this->cookieKey = $cookieKey;
        $this->cookieTimeout = $cookieTimeout;
        $this->db = $db;
    }

    public function load(): array
    {
        return $this->getStorage()->load();
    }

    public function save(array $items): void
    {
        $this->getStorage()->save($items);
    }

    private function getStorage()
    {
        if ($this->storage === null) {
            $cookieStorage = new CookieStorage($this->cookieKey, $this->cookieTimeout);
            if ($this->user->isGuest) {
                $this->storage = $cookieStorage;
            } else {
                $dbStorage = new DbStorage($this->user->id, $this->db);
                if ($cookieItems = $cookieStorage->load()) {
                    $dbItems = $dbStorage->load();
                    $items = array_merge($dbItems, array_udiff($cookieItems, $dbItems, function (CartItem $first, CartItem $second) {
                        return $first->getId() === $second->getId();
                    }));
                    $dbStorage->save($items);
                    $cookieStorage->save([]);
                }
                $this->storage = $dbStorage;
            }
        }
        return $this->storage;
    }
}