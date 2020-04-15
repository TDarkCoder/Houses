<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Billing\CashPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\Contract\PaymentGatewayContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
