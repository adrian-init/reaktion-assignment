<?php

namespace App\Exceptions;


use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ThrottleException extends HttpException
{
    /**
     * Create a new exception instance.
     *
     * @param string|null $message
     * @param \Exception|null $previous
     * @param array $headers
     * @param int $code
     * @return void
     */
    public function __construct($message = null, Exception $previous = null, array $headers = [], $code = 0)
    {
        parent::__construct(429, $message, $previous, $headers, $code);
    }
}
