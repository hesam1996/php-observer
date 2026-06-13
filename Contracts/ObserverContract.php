<?php

namespace Contracts;

interface ObserverContract
{
    public function update($event): void;
}