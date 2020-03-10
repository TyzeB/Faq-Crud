<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $fillable = ['question', 'answer'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
