<?php


namespace Topdot\Core\Traits;


trait InteractsWithRequests
{
    public function getRequest(array $attributes)
    {
        return request()->merge($attributes);
    }
}
