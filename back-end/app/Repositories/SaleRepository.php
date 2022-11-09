<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleRepositoryInterface
{
    public function createSale($sellerId, $value)
    {
        return DB::table('sale')
            ->insert([
                'seller_id' => $sellerId,
                'value' => $value
            ]);
    }

    public function getSellerAllSales($sellerId)
    {
        return DB::table('sale')
            ->where('seller_id', '=', $sellerId)
            ->get();
    }
}
