<?php

namespace App\Console\Commands;

use App\Mail\SalesReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

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
        $sellers = $this->getAllSellers();
        foreach ($sellers as $seller) {
            $sales = $this->getSellerSales($seller->id);

            $sumAllSalesDay = 0;
            foreach ($sales as $sale) {
                $sumAllSalesDay += $sale->value;
            }

            Mail::to($seller->email)->send(new SalesReport($seller, $sumAllSalesDay));
        }
    }

    private function getAllSellers()
    {
        return DB::table('seller')
            ->get();
    }

    private function getSellerSales($sellerId)
    {
        return DB::table('sale')
            ->where('seller_id', '=', $sellerId);
    }
}
