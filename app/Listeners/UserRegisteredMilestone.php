<?php
namespace App\Listeners;


use App\Models\User;
use App\Notifications\UserRegisteredMilestoneNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class UserRegisteredMilestone
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
    public function handle(Registered $event): void
    {
        $userCount = User::count();


        // Check if the user count is a multiple of 100 and if the milestone notification has not been sent
        if ($userCount % 100 === 0 && !Cache::has("user_milestone_{$userCount}_sent")) {
            $admins = User::whereHas('roles', function ($query) {
                $query->where('name', 'Admin');
            })->get();


            foreach ($admins as $admin) {
                $admin->notify(new UserRegisteredMilestoneNotification($userCount));
            }


            // Cache the milestone to prevent duplicate notifications
            Cache::forever("user_milestone_{$userCount}_sent", true);
        }
    }
}

