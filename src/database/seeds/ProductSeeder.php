<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		$wishlists = App\Wishlist::all();
        factory(App\Product::class, 10)->create()->each(function ($product) use($wishlists) {
	        $product->wishlists()->saveMany($wishlists);
	    });
    }
}
