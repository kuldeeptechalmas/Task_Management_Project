<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $post;
    public function __construct($posts)
    {
        $this->post = $posts;   
    }
    
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

    public function broadcastAs()
    {
        return 'save';
    }
    
     public function broadcastWith(): array
    {
        return [
           'message' => "[{$this->post}] New Post Received with title."
        ];
    }
}
