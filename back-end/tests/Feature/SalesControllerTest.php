<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Database\Seeders\SellerSeeder;
use App\Repositories\SellerRepository;
use Database\Seeders\SaleSeeder;
use Tests\TestCase;

class SalesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $sellerId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(
            [
                SellerSeeder::class,
                SaleSeeder::class
            ]
        );

        $sellerRepository = new SellerRepository();

        $sellersIds = $sellerRepository->getAllSellersId();
        $sellerIdRandomIndex = array_rand($sellersIds);
        $this->sellerId = $sellersIds[$sellerIdRandomIndex];
    }


    public function testShouldCreateASaleWithExistingSellerIdAndPositiveValueNumber()
    {
        $response = $this->post('/api/sale/create', ['sellerId' => $this->sellerId, 'value' => rand(1, 1000)]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->hasAny('data', 'id', 'name', 'email', 'commission', 'value', 'sale_date')
                    ->etc()
            );
    }

    public function testShouldListAllSalesByOneSellerId()
    {
        $response = $this->get('/api/sale/' . $this->sellerId . '/show/');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->hasAny('data', 'id', 'value', 'seller_id')
                    ->etc()
            );
    }
}
