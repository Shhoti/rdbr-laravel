<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'candidate_id'
    ];

    protected $casts = [
        'status' => Status::class
    ];

    public function candidate()
    {
        return $this->belongsTo(\App\Models\Candidate::class);
    }

}
