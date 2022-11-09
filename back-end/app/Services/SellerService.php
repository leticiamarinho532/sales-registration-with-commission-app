<?php

namespace App\Services;

use App\Repositories\Interfaces\SellerRepositoryInterface;

class SellerService
{
    private $sellerRepository;

    public function __construct(
        SellerRepositoryInterface $sellerRepository
    ) {
        $this->sellerRepository = $sellerRepository;
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
        $result = $this->sellerRepository->getAllSellers();

        if (empty($result)) {
            return 'Nenhum vendedor cadastrado.';
        }

        return $result;
    }
}
