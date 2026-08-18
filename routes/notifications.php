<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/notifications', function () {
        $user = auth()->user();

        if ($user->role === 'student') {
            return view('student.notifications.index');
        }

        if ($user->role === 'hod') {
            return view('hod.notifications.index');
        }

        if ($user->role === 'admin') {
            return view('admin.notifications.index');
        }

        abort(403);
    })->middleware('auth')->name('notifications.index');

    Route::post('/notifications/{notification}/read', function ($notification) {
        $notification = auth()->user()->notifications()->findOrFail($notification);
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read.');
    })->name('notifications.read');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    })->name('notifications.readAll');

    Route::get('/notifications/{notification}/open', function ($notification) {
        $notification = auth()->user()->notifications()->findOrFail($notification);

        // Mark notification as read
        $notification->markAsRead();

        // Get thesis request ID
        $requestId = $notification->data['thesis_request_id'];
        $status = $notification->data['status'] ?? 'null';

        // Admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route(
                'admin.thesis_requests.show',
                $requestId
            );
        }

        // HoD
        if (auth()->user()->role === 'hod') {
            return redirect()->route(
                'hod.thesis_requests.show',
                $requestId
            );
        }

         if (auth()->user()->role === 'student') {

            // Rejected → My Theses
            if ($status === 'rejected') {
                return redirect()->route('student.thesis_requests.rejected', $requestId);
            }

            // Approved → Thesis Show
            if ($status === 'approved') {
                return redirect()->route(
                    'student.thesis_requests.show',
                    $requestId
                );
            }
        }

        return redirect()->back()->with('error', 'You are not authorized to view this request.');
    })->middleware('auth')->name('notifications.open');
});