<?php

namespace App\Console\Commands;

use App\Mail\SalesReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send report with sum of all sales made on the day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $saleRepository = new SaleRepository();
        $sellerRepository = new SellerRepository();

        $sellers = $sellerRepository->getAllSellers();

        foreach ($sellers as $seller) {
            $sales = $saleRepository->getSellerAllSales($seller->id);

            $sumAllSalesDay = 0;
            foreach ($sales as $sale) {
                // dd();
                if (
                    substr($sale->created_at, 0, 10) === date('Y-m-d')
                ) {
                    $sumAllSalesDay += $sale->value;
                }
            }

            Mail::to($seller->email)->send(new SalesReport($seller, $sumAllSalesDay));
        }
    }
}
