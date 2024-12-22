<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['userId', 'name', 'color'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
