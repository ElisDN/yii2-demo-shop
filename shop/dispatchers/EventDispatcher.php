<?php

namespace shop\dispatchers;

interface EventDispatcher
{
    public function dispatch($event): void;
}