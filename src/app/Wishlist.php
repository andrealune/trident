<?php
  
namespace App;
   
use Illuminate\Database\Eloquent\Model;
   
class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'name'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function products() 
    {
        return $this->belongsToMany('App\Product', 'product_wishlist');
    }
}