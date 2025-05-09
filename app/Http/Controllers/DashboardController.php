<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // $total_users = Cache::remember('total_users', 20, function () {
        //     return User::count();
        // });


        // -- alternative way to use cache
        if(Cache::has('total_users')){
            $total_users = Cache::get('total_users');
        }else{
            $total_users = User::count();
            Cache::put('total_users', $total_users, 300);
        }   

        $total_employees = Cache::remember('total_employees', 20, function () {
            return Employee::count();
        });

        $total_customers = Cache::remember('total_customers', 20, function () {
            return Customer::count();
        });
        
        return view('dashboard', compact('total_users', 'total_employees', 'total_customers'));
    }

    public function index2()
    {
        return view('dashboard2');
    }

    public function index3()
    {
        return view('dashboard3');
    }

        
    public function badcache()
    {
        $html = Cache::remember('badcache-page', 60, function () {
            $total_users = 'DEMO';
            return view('dashboard', compact('total_users'))->render();
        });

        return $html;
    }

    public function aj_daily_sales()
    {
        $sales = \DB::table('invoices')
            ->selectRaw('DATE(invoice_date) as date, SUM(total) as sales')
            ->where('invoice_date', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        sleep(8);

        return response()->json([
            'labels' => $sales->pluck('date'),
            'sales' => $sales->pluck('sales'),
        ]);
    }
}
