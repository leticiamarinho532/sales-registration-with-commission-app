<?php

namespace App\Services;

use App\Repositories\Interfaces\SellerRepositoryInterface;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Services\CommissionService;
use stdClass;

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

        $seller = $this->sellerRepository->createSeller($name, $email);

        if (!$seller) {
            return false;
        }

        $sellerFormattedInfos = $this->formatDefaultSellerCreatedToOutPut($seller);

        return $sellerFormattedInfos;
    }

    public function getAllSellers()
    {
        $sellers = $this->sellerRepository->getAllSellers();
        $comissionService = new CommissionService();

        if (empty($sellers)) {
            return 'Nenhum vendedor cadastrado.';
        }

        $formattedSellers = [];
        foreach ($sellers as $seller) {
            $comissionValue = 0;
            $sales = $this->saleRepository->getSellerAllSales($seller->id);

            foreach ($sales as $sale) {
                $comissionValue = $comissionValue + $comissionService->calculate($sale->value);
            }

            array_push($formattedSellers, $this->formatDefaultSellerToOutput($seller, $comissionValue));
        }


        return $formattedSellers;
    }

    public function formatDefaultSellerToOutput($seller, $commission)
    {
        $sellerInfos = new stdClass();
        $sellerInfos->id = $seller->id;
        $sellerInfos->name = $seller->name;
        $sellerInfos->email = $seller->email;
        $sellerInfos->commission = 'R$' . $commission;

        return $sellerInfos;
    }

    public function formatDefaultSellerCreatedToOutPut($seller)
    {
        $sellerInfos = new stdClass();
        $sellerInfos->id = $seller->id;
        $sellerInfos->name = $seller->name;
        $sellerInfos->email = $seller->email;

        return $sellerInfos;
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
