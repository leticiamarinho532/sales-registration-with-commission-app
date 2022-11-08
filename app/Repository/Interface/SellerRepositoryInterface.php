<?php

namespace App\Repository\Interface;

interface SellerRepositoryInterface
{
    public function createSeller($name, $email);
    public function getAllSellers();
}
