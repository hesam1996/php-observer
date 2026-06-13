<?php

namespace Events;

class DownloadEvent
{
    public function __construct(
        public string $id,
        public string $slug,
        public string $name,
        public string $ip,
        public string $time
    )
    {
    }
}