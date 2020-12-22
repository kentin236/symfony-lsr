<?php

namespace App\Service;

use Symfony\Component\Messenger\MessageBusInterface;

class AsyncService
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }
}