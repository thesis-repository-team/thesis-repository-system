<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\ThesisRequest;
use Illuminate\Notifications\Notification;

class ThesisRequestSubmitted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $thesisRequest;

    public function __construct(ThesisRequest $thesisRequest){
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
     * Get the array representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'thesis_request_id' => $this->thesisRequest->id,
            'title' => 'New Thesis Request',
            'message' => $this->thesisRequest->author_name
                .' submitted a thesis request.',
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
