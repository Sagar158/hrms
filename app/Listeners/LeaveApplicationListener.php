<?php

namespace App\Listeners;

use App\Models\LeaveApplication;
use App\Events\LeaveApplicationEvent;
use App\Models\LeaveApplicationDetails;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeaveApplicationListener
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
    public function handle(LeaveApplicationEvent $event): void
    {
        $leaveApplication = $event->leaveApplication;
        $status = $event->status;
        $userId = auth()->user()->id;

        LeaveApplicationDetails::create([
            'leave_application_id' => $leaveApplication->id,
            'status' => $status,
            'created_by' => $userId,
            'details' => LeaveApplication::STAGE_LABELS[$status]['message']
        ]);

    }
}
