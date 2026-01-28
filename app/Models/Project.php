<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    public function categoryinfo(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function clientinfo(){
        return $this->belongsTo(Client::class,'client_id');
    }

    // public function faqs()
    // {
    //     return $this->hasMany(Faq::class, 'service_id');
    // }
}
