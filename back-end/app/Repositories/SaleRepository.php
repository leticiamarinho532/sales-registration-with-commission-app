<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;

class SaleRepository implements SaleRepositoryInterface
{
    public function createSale($sellerId, $value)
    {
        return Sale::create([
            'seller_id' => $sellerId,
            'value' => $value
        ]);
    }

    public function getSellerAllSales($sellerId)
    {
        return Sale::where('seller_id', '=', $sellerId)
            ->get();
    }
}
