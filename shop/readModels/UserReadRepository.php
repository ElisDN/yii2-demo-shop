<?php

namespace shop\readModels;

use shop\entities\User\User;

class UserReadRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    public function findActiveById($id): ?User
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }
}