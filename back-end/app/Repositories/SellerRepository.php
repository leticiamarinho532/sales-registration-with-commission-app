<?php

namespace App\Repositories;

use App\Models\Seller;
use App\Repositories\Interfaces\SellerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SellerRepository implements SellerRepositoryInterface
{
    public function createSeller($name, $email)
    {
        return Seller::create([
            'name' => $name,
            'email' => $email
        ]);
    }

    public function getAllSellers()
    {
        return Seller::get();
    }

    public function getAllSellersId()
    {
        return Seller::select('id')
            ->get()
            ->pluck('id')
            ->toArray();
    }

    public function getSellerById($sellerId)
    {
        return Seller::where('id', '=', $sellerId)
        ->first();
    }
}
