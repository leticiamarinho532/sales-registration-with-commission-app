<?php

namespace App\Repository;

use App\Repository\Interface\SellerRepositoryInterface;
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
}
