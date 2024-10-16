<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'bank_id',
        'location',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
