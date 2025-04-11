<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Mail\ThankYouForApplying;
use App\Models\VacancyApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewApplicationNotification;

class VacancyApplicationController extends Controller
{
    public function store(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Store the uploaded resume
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create the application
        $application = VacancyApplication::create([
            'vacancy_id' => $vacancy->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'resume_path' => $resumePath,
        ]);

        // Send thank you email to the applicant
        Mail::to($request->email)->queue(new ThankYouForApplying($application));
    
        // Notify all users with the "Manager" role
        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Manager');
        })->get();

        foreach ($managers as $manager) {
            $manager->notify(new NewApplicationNotification($vacancy, $application));
        }

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }
}
