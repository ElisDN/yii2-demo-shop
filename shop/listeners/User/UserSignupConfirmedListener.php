<?php

namespace shop\listeners\User;

use shop\services\newsletter\Newsletter;
use shop\entities\User\events\UserSignUpConfirmed;

class UserSignupConfirmedListener
{
    private $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function handle(UserSignUpConfirmed $event): void
    {
        $this->newsletter->subscribe($event->user->email);
    }
}