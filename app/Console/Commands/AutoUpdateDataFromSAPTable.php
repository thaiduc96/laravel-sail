<?php

namespace App\Console\Commands;

use App\Facades\SapFacade;
use Illuminate\Console\Command;

class AutoUpdateDataFromSAPTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-data-from-sap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AutoUpdateDataFromSAPTable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SapFacade::handleProvider();
        SapFacade::handleWarehouse();
        SapFacade::handleProduct();
        SapFacade::handleCustomer();
//        UpdateDataFromSapJob::dispatch('provider')->delay(now()->addMinutes(1));
//        UpdateDataFromSapJob::dispatch('warehouse')->delay(now()->addMinutes(10));
//        UpdateDataFromSapJob::dispatch('groupPrimary')->delay(now()->addMinutes(20));
//        UpdateDataFromSapJob::dispatch('product')->delay(now()->addMinutes(30));
//        UpdateDataFromSapJob::dispatch('customer')->delay(now()->addMinutes(40));
//        UpdateDataFromSapJob::dispatch('customerAddress')->delay(now()->addMinutes(50));
//        UpdateDataFromSapJob::dispatch('providerProductPurchase')->delay(now()->addMinutes(60));
    }


}
