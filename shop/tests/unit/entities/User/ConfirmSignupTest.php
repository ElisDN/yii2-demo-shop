<?php

namespace shop\tests\unit\entities\User;

use Codeception\Test\Unit;
use shop\entities\User\User;

class ConfirmSignupTest extends Unit
{
    public function testSuccess()
    {
        $user = new User([
            'status' => User::STATUS_WAIT,
            'email_confirm_token' => 'token',
        ]);

        $user->confirmSignup();

        $this->assertEmpty($user->email_confirm_token);
        $this->assertFalse($user->isWait());
        $this->assertTrue($user->isActive());
    }

    public function testAlreadyActive()
    {
        $user = new User([
            'status' => User::STATUS_ACTIVE,
            'email_confirm_token' => null,
        ]);

        $this->expectExceptionMessage('User is already active.');

        $user->confirmSignup();
    }
}