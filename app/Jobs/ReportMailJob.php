<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\DB;

class ReportMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sellers;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $today = now()->setTimezone('America/Sao_Paulo')->toDateString();

        $this->sellers = DB::table('sellers')
            ->select('sellers.*')
            ->join('sales', 'sellers.id', '=', 'sales.seller_id')
            ->whereDate('sales.created_at', $today)
            ->distinct()
            ->get();

        foreach ($this->sellers as $seller) {
            $sales = DB::table('sales')
                ->where('seller_id', $seller->id)
                ->whereDate('created_at', $today)
                ->get();

            // Calcular a soma das vendas e a comissão total diária
            $totalSales = 0;
            $totalComission = 0;
            foreach ($sales as $sale) {
                $totalSales += $sale->amount;
                $totalComission += $sale->comission;
            }
            $seller->comissionTotalDaily = $totalComission;
            $seller->saleTotalDaily = $totalSales;
            $seller->sale = $sales;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->sellers as $seller){
            Mail::to($seller->email, $seller->name)->send(new ReportMail($seller));
        }
    }
}
