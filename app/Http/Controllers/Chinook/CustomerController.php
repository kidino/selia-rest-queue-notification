<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index1()
    {
        // Fetch all customers from the database
        $customers = \App\Models\Customer::all();

        // Return the view with the customers data
        return view('chinook.customer.index1', compact('customers'));
    }

    public function index2()
    {
        // Fetch all customers from the database
        $customers = \App\Models\Customer::with('supportRep')->get();

        // Return the view with the customers data
        return view('chinook.customer.index2', compact('customers'));
    }    
}
