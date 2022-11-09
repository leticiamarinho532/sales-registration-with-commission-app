<?php

namespace App\Repositories\Interfaces;

interface SellerRepositoryInterface
{
    public function createSeller($name, $email);
    public function getAllSellers();
    public function getAllSellersId();
}
