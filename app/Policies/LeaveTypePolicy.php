<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\LeaveType;
use Illuminate\Auth\Access\Response;

class LeaveTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('leave_type.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveType $leaveType): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('leave_type.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('leave_type.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('leave_type.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveType $leaveType): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveType $leaveType): bool
    {
        //
    }
}
