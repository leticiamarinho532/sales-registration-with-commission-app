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
        return DB::table('seller')
            ->get();
    }

    public function getAllSellersId()
    {
        return DB::table('seller')
            ->select('id')
            ->get()
            ->pluck('id')
            ->toArray();
    }

    public function getSellerById($sellerId)
    {
        return DB::table('seller')
            ->where('id', '=', $sellerId)
            ->first();
    }
}
