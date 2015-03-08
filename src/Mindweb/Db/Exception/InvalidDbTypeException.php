<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class InvalidDbTypeException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Invalid db type.');
    }
} 