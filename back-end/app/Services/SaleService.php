<?php

namespace App\Services;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Repositories\Interfaces\SellerRepositoryInterface;
use stdClass;

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

        $sale = $this->saleRepository->createSale($sellerId, $value);

        if (!$sale) {
            return false;
        }

        $saleInfos = $this->formatDefaultSaleToOutput($sellerId, $value, $sale);

        return $saleInfos;
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

        $formattedSalles = [];
        foreach ($sales as $sale) {
            array_push($formattedSalles, $this->formatDefaultSaleToOutput($sellerId, $sale->value, $sale));
        }

        return $formattedSalles;
    }

    public function formatDefaultSaleToOutput($sellerId, $saleValue, $sale)
    {
        $sellerService = new SellerService($this->sellerRepository, $this->saleRepository);
        $comissionService = new CommissionService();

        $sellerInfos = $sellerService->getSellerById($sellerId);

        $saleInfos = new stdClass();
        $saleInfos->id = $sale->id;
        $saleInfos->name = $sellerInfos->name;
        $saleInfos->email = $sellerInfos->email;
        $saleInfos->commission = 'R$' . $comissionService->calculate($saleValue);
        $saleInfos->value = 'R$' . $saleValue;
        $saleInfos->sale_date = $sale->created_at;

        return $saleInfos;
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
