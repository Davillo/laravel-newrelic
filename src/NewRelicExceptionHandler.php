<?php

namespace Davillo\NewRelic;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class NewRelicExceptionHandler
 * @package Davillo\NewRelic
 */
class NewRelicExceptionHandler implements ExceptionHandler
{

    /**
     * @var array list of class names of exceptions that should not be reported to New Relic. Defaults to the
     *            NotFoundHttpException class used for 404 requests.
     */
    protected $ignoredExceptions = [
        NotFoundHttpException::class,
    ];
    
    /**
     * NewRelicExceptionHandler constructor.
     *
     * @param array|false $ignoredExceptions (optional) a list of exceptions to ignore, or false to use the default
     *                                       set
     */
    public function __construct($ignoredExceptions = false)
    {
        if (is_array($ignoredExceptions)) {
            $this->ignoredExceptions = $ignoredExceptions;
        }
    }


    /**
     * @inheritdoc
     * @param Throwable $throwable
     */
    public function report(Throwable $throwable)
    {
        if ($this->shouldReport($throwable)) {
            $this->logException($throwable);
        }
    }


    /**
     * @inheritdoc
     * @param $request
     * @param Throwable $throwable
     */
    public function render($request, Throwable $throwable)
    {

    }


    /**
     * @inheritdoc
     * @param $output
     * @param Throwable $throwable
     */
    public function renderForConsole($output, Throwable $throwable)
    {

    }

    /**
     * @inheritdoc
     * @param Throwable $throwable
     */
    public function shouldReport(Throwable $throwable)
    {
        foreach ($this->ignoredExceptions as $type) {
            if ($throwable instanceof $type) {
                return false;
            }
        }
        return true;
    }

    /**
     * Logs the exception to New Relic (if the extension is loaded)
     *
     * @param Throwable $throwable
     */
    protected function logException(Throwable $throwable)
    {
        if (extension_loaded('newrelic')) {
            newrelic_notice_error($throwable->getMessage(), $throwable);
        }
    }

}
