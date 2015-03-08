<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class ConnectionClassDoesNotExistsException extends RuntimeException
{
    public function __construct($connectionClassName)
    {
        parent::__construct('Connection class doesn\'t exists: ' . $connectionClassName);
    }
} 