<?php

namespace App\Services;

use App\Repository\Interface\SaleRepositoryInterface;
use App\Repository\Interface\SellerRepositoryInterface;

class SaleService
{
    private $saleRepository;
    private $sellerRepository;

    public function __construct(
        SaleRepositoryInterface $saleRepository,
        SellerRepositoryInterface $sellerRepository
    ) {
        $this->saleRepository = $saleRepository;
        $this->sellerRepository = $sellerRepository;
    }

    public function create($sellerId, $value)
    {
        $sellers = $this->sellerRepository->getAllSellersId();

        if (!in_array($sellerId, $sellers)) {
            return false;
        }

        if (!$this->isValidValue($value)) {
            return false;
        }

        // ...
    }

    public function getSellerAllSales($sellerId)
    {
        $sellers = $this->sellerRepository->getAllSellersId();

        if (!in_array($sellerId, $sellers)) {
            return false;
        }

        $sales = $this->saleRepository->getSellerAllSales($sellerId);

        if (empty($sales)) {
            return 'Nenhuma venda registrada.';
        }
    }

    private function isValidValue($value)
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($value < 0) {
            return false;
        }

        return true;
    }
}
