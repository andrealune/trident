<?php
  
namespace App;
   
use Illuminate\Database\Eloquent\Model;
   
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'detail'
    ];

    public function wishlists() 
    {
        return $this->belongsToMany('App\Wishlist', 'product_wishlist')->withTimestamps();
    }
}