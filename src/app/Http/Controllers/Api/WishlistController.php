<?php
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use Validator;

use App\Wishlist;
use App\Product;
use App\Http\Resources\Wishlist as WishlistResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class WishlistController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user = auth()->guard('api')->user();
        $wishlist = $user->wishlists()->create(
            $request->all()
        );
   
        return $this->sendResponse(new WishlistResource($wishlist), 'Wishlist created successfully.');
    } 


    /**
     * Add product to specified wishlist
     *
     * @param  int  $wislist
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wishlist_id' => 'required|exists:wishlists,id',
            'product_id' => 'required|exists:products,id'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $wishlist = Wishlist::find($request->wishlist_id);

        $wishlist->products()->attach($request->product_id);
   
        return $this->sendResponse([], 'Product added to the wishlist successfully.');
    }
}