<?php

namespace Davillo\NewRelic;

use Intouch\Newrelic\Newrelic;
use Illuminate\Support\ServiceProvider;

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
            $newRelic = new Newrelic();
            $newRelic->setAppName(env('NEWRELIC_APP_NAME'), env('NEWRELIC_APP_LICENSE'));
            return $newRelic;
        });
    }

}
