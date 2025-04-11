<?php

namespace App\Http\Controllers\API;

use App\Models\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::select('id', 'title', 'status')->withCount('applications')->get();
        return response()->json($vacancies);
    }

    public function show(Vacancy $vacancy)
    {
        // $vacancy->load('applications:id,vacancy_id,name,email,phone');
        return response()->json($vacancy);
    }
}
