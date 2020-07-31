<?php

namespace App\Repository\Eloquent;

use App\Wishlist;
use App\Repository\WishlistRepositoryInterface;

class WishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Wishlist $model)
   {
       parent::__construct($model);
   }


   /**
    * @param array $attributes
    * @return void
    */
   public function addProduct(Wishlist $model, Int $product_id)
   {
   		$model->products()->attach($product_id);
   }
}