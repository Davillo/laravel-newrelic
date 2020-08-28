<?php

namespace Davillo\NewRelic;

use Illuminate\Support\ServiceProvider;
use Intouch\Newrelic\Newrelic;

/**
 * Class NewRelicServiceProvider
 * @package Davillo\NewRelic
 */
class NewRelicServiceProvider extends ServiceProvider
{
    
    /**
     * Registers the service provider
     */
    public function register()
    {
        $this->app->singleton(Newrelic::class, function() {
            return new Newrelic();
        });
    }

}
