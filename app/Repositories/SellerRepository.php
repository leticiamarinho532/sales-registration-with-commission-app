<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SellerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SellerRepository implements SellerRepositoryInterface
{
    public function createSeller($name, $email)
    {
        return DB::table('seller')
            ->insert([
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
}
