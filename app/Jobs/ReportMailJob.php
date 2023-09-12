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
use App\Services\SellerService;

class ReportMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sellers;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->sellers = SellerService::getSellersWithSalesToday();
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
