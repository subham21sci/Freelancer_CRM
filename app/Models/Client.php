<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public function scopeFilterByDate($query, $date)
    {
        if ($date) {
            return $query->whereDate('created_at', $date);
        }

        return $query;
    }

    public function scopeFilterByStatus($query, $status)
    {
        if ($status !== null && $status !== 'all') {
            return $query->where('status', $status);
        }

        return $query;
    }
}
