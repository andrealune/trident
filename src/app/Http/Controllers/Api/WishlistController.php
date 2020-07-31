<?php
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use Validator;

use App\Repository\WishlistRepositoryInterface;

use App\Http\Resources\Wishlist as WishlistResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class WishlistController extends BaseController
{

    private $wishlistRepository;

    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wishlist = $this->wishlistRepository->create([
            'user_id' => auth()->guard('api')->user()->id,
            'name' => $request->name
        ]);
   
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
        $this->wishlistRepository->addProduct(
            $this->wishlistRepository->find($request->wishlist_id),
            $request->product_id
        );
   
        return $this->sendResponse([], 'Product added to the wishlist successfully.');
    }
}