<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class InvalidDbTypeException extends RuntimeException
{
    public function __construct($type)
    {
        parent::__construct('Invalid db type: ' . $type);
    }
} 