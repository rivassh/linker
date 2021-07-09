<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'request','ip'
    ];



    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
