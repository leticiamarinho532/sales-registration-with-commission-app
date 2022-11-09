<?php

namespace App\Repositories\Interfaces;

interface SaleRepositoryInterface
{
    public function createSale($sellerId, $value);
    public function getSellerAllSales($sellerId);
}
