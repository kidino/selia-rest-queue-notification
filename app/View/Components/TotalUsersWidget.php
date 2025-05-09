<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TotalUsersWidget extends Component
{

    public $total_users;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->total_users = cache()->remember('total_users', 20, function () {
            return User::count();
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.total-users-widget');
    }
}
