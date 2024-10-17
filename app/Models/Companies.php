<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'companies_id',
        'monthly_earnings',
        'hours_worked',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
