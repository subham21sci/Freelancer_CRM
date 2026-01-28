<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;

    public function categoryinfo(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
