<?php

namespace shop\services\sms;

interface SmsSender
{
    public function send($number, $text): void;
}