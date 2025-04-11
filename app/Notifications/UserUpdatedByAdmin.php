<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdatedByAdmin extends Notification
{
    use Queueable;

    public $changedFields;
    public $newRoles;


    /**
     * Create a new notification instance.
     */
    public function __construct($changedFields = [], $newRoles = [])
    {
        $this->changedFields = $changedFields;
        $this->newRoles = $newRoles;    
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your account was updated by an admin.',
            'changed_fields' => $this->changedFields,
            'new_roles' => $this->newRoles,
            'url' => url('/profile') // or wherever they can review the changes
        ];
    }  

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Your Profile Has Been Updated')
            ->line('An administrator has updated your account.');


        if (!empty($this->changedFields)) {
            $message->line('Changed fields: ' . implode(', ', $this->changedFields));
        }

        if (!empty($this->newRoles)) {
            $message->line('Your new roles: ' . implode(', ', $this->newRoles));
        }

        return $message->line('If you have questions, please contact support.');
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
