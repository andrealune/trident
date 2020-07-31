<?php

namespace App\Repository\Eloquent;

use App\Product;
use App\Repository\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Product $model)
   {
       parent::__construct($model);
   }
}