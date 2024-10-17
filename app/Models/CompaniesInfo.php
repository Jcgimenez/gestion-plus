<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }
}
