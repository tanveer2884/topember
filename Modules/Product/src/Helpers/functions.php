<?php

use Topdot\Category\Models\Category;
use Topdot\Core\Models\Manufacturer;

function categories($columns = ['id','name'])
{
    return Category::query()->select($columns)->get();
}

function manufacturers($columns = ['id','name'])
{
    return Manufacturer::query()->select($columns)->get();
}
