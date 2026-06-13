<?php

namespace Observers;

use Classes\LogController;
use Contracts\ObserverContract;

class Analytics implements ObserverContract
{
    private $logController;

    public function __construct()
    {
        $this->logController = new LogController();
    }

    public function update($event): void
    {
        $text = "Tracking download of " . $event->name . " downloaded \n";
        $ip = getUserIP();
        $this->logController->store($text, "Analytics", $ip);
    }
}