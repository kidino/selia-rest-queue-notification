<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    public function applications()
    {
        return $this->hasMany(VacancyApplication::class);
    }
}
