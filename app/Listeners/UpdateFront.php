<?php

namespace App\Listeners;

use App\Events\LikedPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFront
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  LikedPost  $event
     * @return void
     */
    public function handle(LikedPost $event)
    {
        dd("Avisei e passei ao front o que foi atualizado")
    }
}
