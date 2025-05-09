<?php

namespace App\View\Components;

use Closure;
use App\Models\Customer;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class TotalCustomersWidget extends Component
{
    public $total_customers;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->total_customers = Cache::remember('total_customers', 20, function () {
            return Customer::count();
        });    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.total-customers-widget');
    }
}
