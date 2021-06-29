<?php


namespace Topdot\Core\Traits;


trait WithUniqueId
{
    public function getUniqueKey($prefix='')
    {
        return md5($prefix.microtime().$this->id);
    }
}
