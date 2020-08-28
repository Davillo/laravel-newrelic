<?php

namespace Davillo\NewRelic;

use Closure;
use Illuminate\Http\Request;
use Davillo\NewRelic\NewRelicMiddleware;

/**
 * Class NewRelicBackgroundJobMiddleware
 * @package Davillo\NewRelic
 */
class NewRelicBackgroundJobMiddleware extends NewRelicMiddleware
{
    /**
     * @inheritdoc
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Mark the request as a background job
        $this->newRelic->backgroundJob();

        return $next($request);
    }
}
