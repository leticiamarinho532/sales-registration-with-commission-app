<?php

namespace App\Services;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Repositories\Interfaces\SellerRepositoryInterface;

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

        $result = $this->saleRepository->createSale($sellerId, $value);

        if (!$result) {
            return false;
        }

        return 'Venda registrada com sucesso.';
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

        return $sales;
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
