<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Mail\ThankYouForApplying;
use App\Models\VacancyApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewApplicationNotification;

class VacancyApplicationController extends Controller
{
    /**
     * Store a new vacancy application.
     */
    public function store(Request $request, Vacancy $vacancy)
    {
    }

    public function index(Vacancy $vacancy)
    {
        $applications = $vacancy->applications;
        return view('vacancies.applications.index', compact('vacancy', 'applications'));
    }
}
