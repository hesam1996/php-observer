<?php

namespace Observers;

use Classes\LogController;
use Contracts\ObserverContract;

class Logger implements ObserverContract
{
    private $logController;

    public function __construct()
    {
        $this->logController = new LogController();
    }

    public function update($event): void
    {
        $text = "File " . $event->name . " downloaded \n";
        $ip = getUserIP();
        $this->logController->store($text, 'Logger', $ip);
    }
}