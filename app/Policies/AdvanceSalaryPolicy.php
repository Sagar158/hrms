<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\AdvanceSalary;
use Illuminate\Auth\Access\Response;

class AdvanceSalaryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('advance_salary.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdvanceSalary $advanceSalary): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('advance_salary.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('advance_salary.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('advance_salary.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AdvanceSalary $advanceSalary): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AdvanceSalary $advanceSalary): bool
    {
        //
    }
}
