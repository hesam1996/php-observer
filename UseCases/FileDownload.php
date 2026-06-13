<?php
//=====================================================
// Main duty is calling others ===========================
//=====================================================

namespace UseCases;

use Contracts\ObserverContract;
use Contracts\ObserverSubjectContract;
use Events\DownloadEvent;

class FileDownload implements ObserverSubjectContract
{
    private array $observers = [];

    public function download(int $id, string $slug, string $name): void
    {
        $event = new DownloadEvent(
            $id,
            $slug,
            $name,
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            date('Y-m-d H:i:s')
        );

        $this->notify($event);
    }

    public function attach(ObserverContract $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverContract $observer): void
    {
        foreach ($this->observers as $key => $o) {
            if ($o === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify($event): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($event);
        }
    }
}