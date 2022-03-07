<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'status_history_id'
    ];


    public function statusHistory()
    {
        return $this->belongsTo(\App\Models\StatusHistory::class);
    }

}
