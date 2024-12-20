<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['domain_id', 'full_url'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}

