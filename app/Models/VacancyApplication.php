<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyApplication extends Model
{
    use HasFactory;

    protected $fillable = ['vacancy_id', 'name', 'email', 'phone', 'resume_path'];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
