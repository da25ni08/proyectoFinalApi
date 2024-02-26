<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pub_type extends Model
{
    use HasFactory;

    public function publication() {
        return $this->belongsToMany(Publication::class);
    }
}
