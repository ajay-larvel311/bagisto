<?php

namespace Webkul\AdvancedFilters\Console\Commands;

use Illuminate\Console\Command;
use Webkul\AdvancedFilters\Providers\AdvancedFiltersServiceProvider;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advanced-filters:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs and configures the Advanced Filters package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running package installation...');

        $this->call('migrate');

        $this->call('vendor:publish', [
            '--provider' => AdvancedFiltersServiceProvider::class,
            '--force' => true,
        ]);

        $this->call('optimize:clear');

        $this->info('🎉 Advanced Filters package installed successfully!');
    }
}
