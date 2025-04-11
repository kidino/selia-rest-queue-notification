<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api/user', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()->id ?: $request->ip());
        });

        VerifyEmail::toMailUsing(function(object $notifiable, string $url){
            return (new MailMessage)
                ->subject('Sila sahkan alamat email anda')
                ->greeting('Salam sejahtera!')
                ->line('Terima kasih kerana mendaftar di sistem APP 02.')
                ->line('Sebelum meneruskan penggunaan sistem, sila sahkan alamat email anda dengan mengklik butang di bawah.')
                ->action('Sahkan Email Anda', $url)
                ->salutation('Terima kasih');
        });

        Gate::define('is-admin', function (User $user) {
            return $user->hasRole('Admin');
        });        

    }
}
