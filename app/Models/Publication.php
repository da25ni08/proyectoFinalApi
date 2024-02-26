<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function commerces()
    {
        return $this->belongsToMany(Commerce::class);
    }

    public function pub_type() {
        return $this->hasOne(Pub_type::class);
    }
}
