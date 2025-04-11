<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminUserLoggedIn extends Notification
{
    use Queueable;

    public $user;
    public $ipAddress;
    public $timestamp;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $ipAddress, $timestamp)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->timestamp = $timestamp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Admin User Logged In')
                    ->line('An admin user has logged in.')
                    ->line('User: ' . $this->user->email)
                    ->line('IP Address: ' . $this->ipAddress)
                    ->line('Timestamp: ' . $this->timestamp)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
