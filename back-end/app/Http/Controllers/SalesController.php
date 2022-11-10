<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;
use App\Services\SaleService;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    private $saleRepository;
    private $sellerRepository;

    public function __construct(
        SaleRepository $saleRepository,
        SellerRepository $sellerRepository
    ) {
        $this->saleRepository = $saleRepository;
        $this->sellerRepository = $sellerRepository;
    }

    public function createSale(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sellerId' => 'required|integer',
                'value' => 'required|numeric',
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

        $saleService = new SaleService(
            $this->saleRepository,
            $this->sellerRepository
        );

        $output = $saleService->create($request->input('sellerId'), $request->input('value'));

        if (!$output) {
            return response()->json([
                'retcode' => 'SERVER_ERROR',
                'data' => '',
                'message' => 'Um erro ocorreu ao tentar salvar a venda.'
            ]);
        }

        return response()->json([
            'retcode' => 'SUCCESS',
            'data' => $output,
            'message' => ''
        ]);
    }

    public function GetAllSellerSales(Request $request)
    {
        $request->merge(['sellerId' => $request->route('sellerId')]);

        $validator = Validator::make(
            $request->all(),
            [
                'sellerId' => 'required|integer',
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

        $saleService = new SaleService(
            $this->saleRepository,
            $this->sellerRepository
        );

        $output = $saleService->getSellerAllSales($request->input('sellerId'));

        if (!$output) {
            return response()->json([
                'retcode' => 'SERVER_ERROR',
                'data' => '',
                'message' => 'Não foi possivel exibir resultados.'
            ]);
        }

        return response()->json([
            'retcode' => 'SUCCESS',
            'data' => $output,
            'message' => 'sucesso.'
        ]);
    }
}
