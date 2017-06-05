<?php

namespace shop\services\sms;

use yii\log\Logger;

class LoggedSender implements SmsSender
{
    private $next;
    private $logger;

    public function __construct(SmsSender $next, Logger $logger)
    {
        $this->next = $next;
        $this->logger = $logger;
    }

    public function send($number, $text): void
    {
        $this->next->send($number, $text);
        $this->logger->log('Message to ' . $number . ': ' . $text, Logger::LEVEL_INFO);
    }
}