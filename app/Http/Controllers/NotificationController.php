<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($notification)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($notification);

        $notification->markAsRead();

        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }
}
