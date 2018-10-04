<?php

namespace App\Models;

class ExampleChildren extends Model
{
    public $table = 'example_children';
    
    public function parent()
    {
        return $this->belongsTo(Example::class);
    }
}
