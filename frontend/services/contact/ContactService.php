<?php

namespace frontend\services\contact;

use frontend\forms\ContactForm;

class ContactService
{
    private $supportEmail;
    private $adminEmail;

    public function __construct($supportEmail, $adminEmail)
    {
        $this->supportEmail = $supportEmail;
        $this->adminEmail = $adminEmail;
    }

    public function send(ContactForm $form): void
    {
        $sent = \Yii::$app->mailer->compose()
            ->setFrom($this->supportEmail)
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}