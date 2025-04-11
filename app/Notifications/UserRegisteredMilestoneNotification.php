<?php
namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;


class UserRegisteredMilestoneNotification extends Notification
{
    use Queueable;


    protected $userCount;


    /**
     * Create a new notification instance.
     */
    public function __construct($userCount)
    {
        $this->userCount = $userCount;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['mail'];


        if (!empty($notifiable->phone) 
        && preg_match('/^\+[1-9]\d{1,4} \d{4,14}$/', $notifiable->phone)) {
            $channels[] = TwilioChannel::class;
        }


        return $channels;
    }


    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Milestone Reached: {$this->userCount} Users Registered!")
            ->greeting('Hello!')
            ->line("We are excited to announce that we have reached {$this->userCount} registered users on " . config('app.name') . "!")
            ->action('View Users', url('/user'))
            ->line('Thank you for being a part of our journey!');
    }


    /**
     * Get the Twilio SMS representation of the notification.
     */
    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content('We have reached ' . $this->userCount .
            ' registered users in '. config('app.name') .'. Congratulations!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Milestone reached: {$this->userCount} users registered!",
            'user_count' => $this->userCount,
        ];
    }
}

