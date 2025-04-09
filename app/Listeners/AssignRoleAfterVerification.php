<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignRoleAfterVerification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $event->user->assignRole('member'); // Assign default role

        // Optional: Log the assignment
//        activity()
//            ->causedBy($event->user)
//            ->log("Assigned member role after verification");
    }
}
