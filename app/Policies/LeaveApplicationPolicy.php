<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\LeaveApplication;
use Illuminate\Auth\Access\Response;

class LeaveApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('leave_application.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveApplication $leaveApplication): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('leave_application.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('leave_application.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('leave_application.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveApplication $leaveApplication): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveApplication $leaveApplication): bool
    {
        //
    }
}
