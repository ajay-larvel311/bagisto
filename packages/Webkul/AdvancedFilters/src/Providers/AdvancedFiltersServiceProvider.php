<?php

namespace Webkul\AdvancedFilters\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\AdvancedFilters\Contracts\CustomerFeedback as CustomerFeedbackContract;
use Webkul\AdvancedFilters\Console\Commands\Install;
use Webkul\AdvancedFilters\Http\Controllers\Shop\API\CategoryController as CustomCategoryController;
use Webkul\AdvancedFilters\Models\CustomerFeedback;
use Webkul\AdvancedFilters\Repositories\ProductRepository as CustomProductRepository;
use Webkul\Product\Repositories\ProductRepository as BaseProductRepository;
use Webkul\Shop\Http\Controllers\API\CategoryController as BaseCategoryController;

class AdvancedFiltersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'advancedfilters');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'advancedfilters');
        $this->app->register(ModuleServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->overrideCoreClasses();
        $this->publishResources();

         if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }
    }

    /**
     * Register services.
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/system.php',
            'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/bagisto-vite.php',
            'bagisto-vite.viters'
        );
    }

    /**
     * Publish resources.
     */
    protected function publishResources()
    {
        /**
         * Publish the assets.
         */
        $this->publishes([
            __DIR__ .'/../../publishable' => public_path('/')
        ], 'public');

        $this->publishes([
            __DIR__.'/../Resources/views/shop/components/products/card.blade.php' => resource_path('themes/default/views/components/products/card.blade.php'),

            __DIR__.'/../Resources/views/shop/products/view.blade.php' => resource_path('themes/default/views/products/view.blade.php'),

            __DIR__.'/../Resources/views/shop/categories/filters.blade.php' => resource_path('themes/default/views/categories/filters.blade.php'),
        ], 'advancedfilters-views');
    }

    /**
     * Override core classes.
     */
    protected function overrideCoreClasses()
    {
        $this->app->bind(CustomerFeedbackContract::class, CustomerFeedback::class);
        $this->app->bind(BaseProductRepository::class, CustomProductRepository::class);
        $this->app->bind(BaseCategoryController::class, CustomCategoryController::class);
    }
}
