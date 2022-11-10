<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SellerRepository;
use App\Repositories\SaleRepository;
use Illuminate\Support\Facades\Validator;
use App\Services\SellerService;

class SellersController extends Controller
{
    private $sellerRepository;
    private $saleRepository;

    public function __construct(
        SellerRepository $sellerRepository,
        SaleRepository $saleRepository
    ) {
        $this->sellerRepository = $sellerRepository;
        $this->saleRepository = $saleRepository;
    }

    public function createSeller(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email',
            ],
            [
                'required' => ':attribute deve ser declarado no body',
                'type' => ':attribute deve ser tipo :type',

            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'retcode' => 'ERROR',
                'data' => '',
                'message' => $validator->messages()
            ]);
        }

        $sellerService = new SellerService(
            $this->sellerRepository,
            $this->saleRepository
        );

        $output = $sellerService->create($request->input('name'), $request->input('email'));

        if (!$output) {
            return response()->json([
                'retcode' => 'SERVER_ERROR',
                'data' => '',
                'message' => 'Um erro ocorreu ao tentar criar um vendedor.'
            ]);
        }

        return response()->json([
            'retcode' => 'SUCCESS',
            'data' => $output,
            'message' => ''
        ]);
    }

    public function getAllSellers()
    {
        $sellerService = new SellerService(
            $this->sellerRepository,
            $this->saleRepository
        );

        $output = $sellerService->getAllSellers();

        if (!$output) {
            return response()->json([
                'retcode' => 'SERVER_ERROR',
                'data' => '',
                'message' => 'Um erro ocorreu ao tentar criar um vendedor.'
            ]);
        }

        return response()->json([
            'retcode' => 'SUCCESS',
            'data' => $output,
            'message' => ''
        ]);
    }
}
