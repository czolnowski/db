<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class ConnectionClassDoesNotImplementConnectionException extends RuntimeException
{
    public function __construct($connectionClassName)
    {
        parent::__construct('Connection class doesn\'t implement Connection abstract: ' . $connectionClassName);
    }
} 