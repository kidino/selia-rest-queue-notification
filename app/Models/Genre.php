<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'genres';

    protected $fillable = [
        'name',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
