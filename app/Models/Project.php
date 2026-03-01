<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'client_id',
        'project_name',
        'slug',
        'domain',
        'description',
        'status',
        'start_date',
        'tag_id',
    ];

    public function categoryinfo()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function clientinfo()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    //  Tag IDs as array
    public function getTagIdsAttribute()
    {
        if (!$this->tag_id) {
            return [];
        }

        return array_map('intval', explode(',', $this->tag_id));
    }

    //  Tag names collection
    public function getTagNamesAttribute()
    {
        if (!$this->tag_id) {
            return collect();
        }

        return Tag::whereIn('id', $this->tag_ids)->pluck('name');
    }

}
