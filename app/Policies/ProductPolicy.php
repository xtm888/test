<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param Product $product
     * @return bool
     */
    public function view(Product $product): bool
    {
        return $product->active;
    }

    /**
     * Determine whether the user can create products.
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isVendor();
    }

    /**
     * Determine whether the user can update the product.
     *
     * @return bool
     */
    public function update(User $user, Product $product): bool
    {

        // product can be updated by the owner or by the admin/moderator
        return ($product->user->id == $user->id || $user->isAdmin() || $user->hasPermission('products')) && $product->active;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @return false
     */
    public function delete()
    {
        return false; // forbid deleting
    }

}
