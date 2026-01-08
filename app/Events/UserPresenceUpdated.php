<?php

namespace App\Events;

use App\Models\UserPresence;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserPresenceUpdated implements ShouldBroadcast
{
    public function broadcastOn()
    {
        return new Channel('admin-dashboard');
    }

    public function broadcastAs()
    {
        return 'presence.updated';
    }

    public function broadcastWith()
    {
        return [
            'onlineAdmins' => UserPresence::where('user_type','admin')
                ->where('is_online', true)->count(),

            'onlineCustomers' => UserPresence::where('user_type','customer')
                ->where('is_online', true)->count(),
        ];
    }
}
