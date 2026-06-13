<?php

namespace Contracts;

interface ObserverSubjectContract
{
    public function attach(ObserverContract $observer): void;

    public function detach(ObserverContract $observer): void;

    public function notify($event): void;
}