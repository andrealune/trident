<?php

namespace App\Http\Requests;

use \Illuminate\Http\Request;

class Wishlist
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function create(Request $request)
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function addProduct(Request $request)
    {
        return [
            'wishlist_id' => 'required|exists:wishlists,id',
            'product_id' => 'required|exists:products,id'
        ];
    }
}
