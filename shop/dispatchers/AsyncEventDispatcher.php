<?php

namespace shop\dispatchers;

use shop\jobs\AsyncEventJob;
use yii\queue\Queue;

class AsyncEventDispatcher implements EventDispatcher
{
    private $queue;

    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }

    public function dispatch($event): void
    {
        $this->queue->push(new AsyncEventJob($event));
    }
}