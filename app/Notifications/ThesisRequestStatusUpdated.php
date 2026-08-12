<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\ThesisRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThesisRequestStatusUpdated extends Notification
{
    use Queueable;
    public $thesisRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(ThesisRequest $thesisRequest)
    {
        $this->thesisRequest = $thesisRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'thesis_request_id' => $this->thesisRequest->id,
            'title' => $this->thesisRequest->title,
            'status' => $this->thesisRequest->status,
            'message' => $this->thesisRequest->status === 'approved'
                ? 'Your thesis request has been approved.'
                : 'Your thesis request has been rejected.',
        ];
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
