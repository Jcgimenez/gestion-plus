<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
