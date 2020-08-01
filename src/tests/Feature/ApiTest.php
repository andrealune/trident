<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DB;
use App\User;
use App\Product;
use App\Wishlist;
use Laravel\Passport\Passport;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $password = 'password';

    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::first();
    }

    /**
     * Reset the migrations
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Test API Login
     *
     * @return void
     */
    public function testLogin()
    {
        $data = [
            'email' => $this->user->email,
            'password' => $this->password
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'token' => true
                ],                
            ])
            ->assertJsonPath('data.name', $this->user->name);
    }

    public function testProductList()
    {
        Passport::actingAs($this->user);

        $data = $this->getJson(route('products.all'))
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => array(),                
            ]);
    }

    public function testProductCreate()
    {
        Passport::actingAs($this->user);

        $data = [
            'name' => 'Product1',
            'detail' => 'ProductDetail',
        ];

        $this->postJson(route('products.create'),$data)->assertStatus(200);
        $this->assertDatabaseHas('products', $data);
    }

    public function testWishlistCreate()
    {
        Passport::actingAs($this->user);

        $data = [
            'name' => 'Wishlist1'
        ];

        $this->postJson(route('wishlists.create'),$data)->assertStatus(200);
        $this->assertDatabaseHas('wishlists', $data);
    }

    public function testWishlistAddProduct()
    {
        Passport::actingAs($this->user);

        DB::table('product_wishlist')->delete();

        $data = [
            'wishlist_id' => Product::first()->id,
            'product_id' => Wishlist::first()->id,
        ];

        $this->postJson(route('wishlists.add.product'),$data)->assertStatus(200);
        $this->assertDatabaseCount('product_wishlist', 1);
        $this->assertDatabaseHas('product_wishlist', $data);
    }
}
