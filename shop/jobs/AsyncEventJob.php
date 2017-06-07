<?php

namespace shop\jobs;

class AsyncEventJob extends Job
{
    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }
}