<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;


    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'min_salary',
        'max_salary',
        'linkedin_url',
    ];

    public function skills()
    {
        return $this->hasMany(\App\Models\Skill::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(\App\Models\StatusHistory::class)->orderBy('created_at','DESC');
    }

    public function status()
    {
        return $this->hasOne(\App\Models\StatusHistory::class)->orderBy('created_at','DESC');
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('cv')->singleFile();
    }
  

}
