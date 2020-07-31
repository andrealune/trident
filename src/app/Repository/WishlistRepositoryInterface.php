<?php

namespace App\Repository;

use App\Wishlist;
use Illuminate\Database\Eloquent\Model;

interface WishlistRepositoryInterface {

	/**
    * @param array $attributes
    * @return void
    */
   public function addProduct(Wishlist $model, Int $product_id);

}