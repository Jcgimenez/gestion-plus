<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'bank_id',
        'company',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
