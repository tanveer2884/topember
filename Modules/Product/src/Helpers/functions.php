<?php

use Topdot\Category\Models\Category;

function categories($columns = ['id','name'])
{
    return Category::query()->select($columns)->get();
}
