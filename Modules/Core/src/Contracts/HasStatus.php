<?php 

namespace Topdot\Core\Contracts;

interface HasStatus
{
    public function markActive(bool $status= true);
    public function isActive(): bool;
}