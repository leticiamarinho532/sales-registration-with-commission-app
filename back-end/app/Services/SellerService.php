<?php

namespace App\Services;

use App\Repositories\Interfaces\SellerRepositoryInterface;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Services\CommissionService;

class SellerService
{
    private $sellerRepository;
    private $saleRepository;

    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        SaleRepositoryInterface $saleRepository
    ) {
        $this->sellerRepository = $sellerRepository;
        $this->saleRepository = $saleRepository;
    }

    public function create($name, $email)
    {
        if (!is_string($name)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $result = $this->sellerRepository->createSeller($name, $email);

        if (!$result) {
            return false;
        }

        return 'Vendedor cadastrado com sucesso.';
    }

    public function getAllSellers()
    {
        $sellers = $this->sellerRepository->getAllSellers();
        $comissionService = new CommissionService();

        if (empty($sellers)) {
            return 'Nenhum vendedor cadastrado.';
        }

        foreach ($sellers as $seller) {
            $comissionValue = 0;
            $sales = $this->saleRepository->getSellerAllSales($seller->id);

            foreach ($sales as $sale) {
                $comissionValue = $comissionValue + $comissionService->calculate($sale->value);
            }

            $seller->commission = 'R$' . $comissionValue;
        }


        return $sellers;
    }

    public function getSellerById($sellerId)
    {
        $seller = $this->sellerRepository->getSellerById($sellerId);

        if (!$seller) {
            return false;
        }

        return $seller;
    }
}
