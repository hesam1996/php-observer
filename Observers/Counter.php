<?php

namespace Observers;

use Classes\FileController;
use Classes\LogController;
use Contracts\ObserverContract;

class Counter implements ObserverContract
{
    private $fileController;
    private $logController;

    public function __construct()
    {
        $this->fileController = new FileController();
        $this->logController = new LogController();
    }

    public function update($event): void
    {
        $this->fileController->incrementDownload($event->id);

        $text = "Increase download count " . $event->name . "\n";
        $ip = getUserIP();
        $this->logController->store($text, "Counter", $ip);
    }
}