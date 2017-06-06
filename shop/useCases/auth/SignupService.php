<?php

namespace shop\useCases\auth;

use shop\access\Rbac;
use shop\dispatchers\EventDispatcher;
use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use shop\useCases\auth\events\UserSignUpConfirmed;
use shop\useCases\auth\events\UserSignUpRequested;

class SignupService
{
    private $users;
    private $roles;
    private $transaction;
    private $dispatcher;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction,
        EventDispatcher $dispatcher
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->dispatcher = $dispatcher;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
        $this->dispatcher->dispatch(new UserSignUpRequested($user));
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
        $this->dispatcher->dispatch(new UserSignUpConfirmed($user));
    }
}