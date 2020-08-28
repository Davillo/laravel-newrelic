<?php

namespace Davillo\NewRelic;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

/**
 * Class ChainedExceptionHandler
 * @package Davillo\NewRelic\ChainedExceptionHandler
 */
class ChainedExceptionHandler implements ExceptionHandler
{

    /**
     * @var ExceptionHandler
     */
    private $primaryHandler;

    /**
     * @var ExceptionHandler[]
     */
    private $secondaryHandlers;

    /**
     * ChainedExceptionHandler constructor.
     *
     * @param ExceptionHandler   $primaryHandler
     * @param ExceptionHandler[] $secondaryHandlers (optional)
     */
    public function __construct(ExceptionHandler $primaryHandler, array $secondaryHandlers = [])
    {
        $this->primaryHandler    = $primaryHandler;
        $this->secondaryHandlers = $secondaryHandlers;
    }


    /**
     * @inheritdoc
     * @param Throwable $throwable
     */
    public function report(Throwable $throwable)
    {
        $this->primaryHandler->report($throwable);

        foreach ($this->secondaryHandlers as $handler) {
            $handler->report($throwable);
        }
    }

    /**
     * @inheritdoc
     * @param $request
     * @param Throwable $throwable
     */
    public function render($request, Throwable $throwable)
    {
        return $this->primaryHandler->render($request, $throwable);
    }


    /**
     * @inheritdoc
     * @param mixed $output
     * @param Throwable $throwable
     */
    public function renderForConsole($output, Throwable $throwable)
    {
        $this->primaryHandler->renderForConsole($output, $throwable);
    }

    /**
     * @inheritdoc
     * @param Throwable
     */
    public function shouldReport(Throwable $throwable)
    {
        $this->primaryHandler->shouldReport($throwable);
    }

}
