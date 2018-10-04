<?php

namespace App\Models;

class Example extends Model
{
    public function children()
    {
        return $this->hasMany(ExampleChildren::class, 'parent_id');
    }
}
