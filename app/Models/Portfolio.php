<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    // relation ship
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
