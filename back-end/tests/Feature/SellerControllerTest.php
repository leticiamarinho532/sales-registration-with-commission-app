<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\SellerSeeder;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;

class SellerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SellerSeeder::class);
    }

    public function testSouldCreateSellerWithStringNameAndValidEmail()
    {
        $response = $this->post('/api/seller/create', ['name' => Str::random(10), 'email' => fake()->unique()->email()]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->hasAny('data', 'id', 'name', 'email')
                    ->etc()
            );
    }

    public function testShouldListAllSellersRegistered()
    {
        $response = $this->get('/api/seller/show/');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->hasAny('data', 'id', 'value', 'seller_id')
                    ->etc()
            );
    }
}
