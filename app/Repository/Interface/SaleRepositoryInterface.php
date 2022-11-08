<?php

namespace App\Repository\Interface;

interface SaleRepositoryInterface
{
    public function createSale($sellerId, $value);
    public function getSellerAllSales($sellerId);
}
