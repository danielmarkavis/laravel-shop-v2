<?php

namespace App\Providers;

use App\Services\PaymentServiceInterface;
use App\Services\PaypalGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $models = array(
            'Cart',
            'Payment'
        );

        foreach ($models as $model) {
            $this->app->bind("App\Services\\{$model}ServiceInterface", "App\Services\\{$model}Service");
        }

        $this->app->bind(PaymentServiceInterface::class, function() {
            return new PaypalGateway(); // Add switch here for different payment methods
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
