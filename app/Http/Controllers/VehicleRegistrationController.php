<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessVehicleRegistrationUpload;

class VehicleRegistrationController extends Controller
{
    
    public function create() {
        return view('vehicle-registration.upload');
    }

    public function store(Request $request) {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $path = $request->file('csv_file')->store('uploads');

        ProcessVehicleRegistrationUpload::dispatch( $path );

        return redirect()->back()->with('success','file has been uploaded and will be processed soon');
    }

}
