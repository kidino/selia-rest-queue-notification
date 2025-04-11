<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use App\Notifications\AdminUserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckAdminRoleLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::info('User logged in: ' . $event->user->email);

        if ($event->user->hasRole('Admin')) {
            $excludedUserId = $event->user->id;

            // Retrieve IP address and timestamp
            $ipAddress = request()->ip();
            $timestamp = now()->toDateTimeString();

            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'Admin');
            })
            ->where('id', '!=', $excludedUserId)
            ->get();

            foreach ($adminUsers as $adminUser) {
                $adminUser->notify(new AdminUserLoggedIn($event->user, $ipAddress, $timestamp));
            }
        }
    }
}
