<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

class CustomVerifyEmail extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verify Your Email - Life University Thesis Repository')
            ->view('emails.verify-email', [
                'user' => $notifiable,
                'url' => $this->verificationUrl($notifiable),
            ]);
    }

    
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Verify Your Email - Life University Thesis Repository')
    //         ->greeting('Hello ' . ($notifiable->name ?? $notifiable->username) . '!')
    //         ->line('Thank you for registering with the Life University Thesis Repository.')
    //         ->line('Please verify your email address to activate your account.')
    //         ->action('Verify Email Address', $this->verificationUrl($notifiable))
    //         ->line('If you did not create this account, no further action is required.')
    //         ->salutation('Regards,')
    //         ->salutation('Life University Thesis Repository');
    // }

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