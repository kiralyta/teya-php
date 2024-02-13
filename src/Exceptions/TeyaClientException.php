<?php

namespace Kiralyta\TeyaPhp\Exceptions;

use Exception;

class TeyaClientException extends Exception
{
    /**
     * __construct
     *
     * @param  string    $message
     * @param  int       $code
     * @param  Exception $previous
     * @return void
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
