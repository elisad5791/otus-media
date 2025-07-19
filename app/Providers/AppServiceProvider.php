<?php

namespace App\Providers;

use App\Application\Factory\NewsFactory;
use App\Application\Gateway\HttpGateway\HttpGatewayInterface;
use App\Domain\Factory\NewsFactoryInterface;
use App\Domain\Repository\NewsRepositoryInterface;
use App\Infrastructure\Gateway\HttpGateway;
use App\Infrastructure\Repository\NewsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NewsFactoryInterface::class, NewsFactory::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(HttpGatewayInterface::class, HttpGateway::class);
    }
}
