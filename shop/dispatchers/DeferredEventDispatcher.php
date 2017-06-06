<?php

namespace shop\dispatchers;

class DeferredEventDispatcher implements EventDispatcher
{
    private $defer = false;
    private $queue = [];
    private $next;

    public function __construct(EventDispatcher $next)
    {
        $this->next = $next;
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }

    public function dispatch($event): void
    {
        if ($this->defer) {
            $this->queue[] = $event;
        } else {
            $this->next->dispatch($event);
        }
    }

    public function defer(): void
    {
        $this->defer = true;
    }

    public function clean(): void
    {
        $this->queue = [];
        $this->defer = false;
    }

    public function release(): void
    {
        foreach ($this->queue as $i => $event) {
            $this->next->dispatch($event);
            unset($this->queue[$i]);
        }
        $this->defer = false;
    }
}