<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Product $product): bool
    {
        $allowedEmails = config('umkm.product_admin_emails', []);

        return $user->id === $product->admin_id || in_array($user->email, $allowedEmails);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Product $product): bool
    {
        $allowedEmails = config('umkm.product_admin_emails', []);

        return $user->id === $product->admin_id || in_array($user->email, $allowedEmails);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Product $product): bool
    {
        return false;
    }
}
