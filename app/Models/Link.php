<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
      'source',
      'destination',
      'token'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}
