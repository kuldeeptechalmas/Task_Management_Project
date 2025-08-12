<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $post;
    /**
     * Create a new event instance.
     */
    public function __construct($post)
    {
        // dd($post);
        $this->post = $post;   
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return new Channel('mychannel');
    }

    public function broadcastOnAs()
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
