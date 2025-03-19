<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateVisitCount
{
    public function handle(Login $event)
    {
        $event->user->increment('visit_count');
    }
}

