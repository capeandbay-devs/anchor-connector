<?php

namespace CapeAndBay\AnchorCMS;

use Illuminate\Support\ServiceProvider;

class AnchorCMSServiceProvider extends ServiceProvider
{
    // Indicates if loading of the provider is deferred.
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadConfigs();

        $this->publishFiles();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the AlCommerce object to Laravel's service container
        $this->app->singleton('AnchorCMS', function ($app) {
            return new \CapeAndBay\AnchorCMS\AnchorCMS($app);
        });
    }

    public function loadConfigs()
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(__DIR__.'/config/anchor-cms.php', 'anchor-cms');

        // add the root disk to filesystem configuration
        app()->config['filesystems.disks.'.config('anchor-cms.root_disk_name')] = [
            'driver' => 'local',
            'root'   => base_path(),
        ];
    }

    public function publishFiles()
    {
        $capeandbay_config_files = [__DIR__.'/config' => config_path()];

        $minimum = array_merge(
            $capeandbay_config_files
        );

        // register all possible publish commands and assign tags to each
        $this->publishes($capeandbay_config_files, 'config');
        $this->publishes($minimum, 'minimum');
    }
}
