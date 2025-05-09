<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TotalEmployeesWidget extends Component
{
    public $total_employees;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->total_employees = cache()->remember('total_employees', 20, function () {
            return \App\Models\Employee::count();
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.total-employees-widget');
    }
}
