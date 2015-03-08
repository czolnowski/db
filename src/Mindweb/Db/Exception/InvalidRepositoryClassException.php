<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class InvalidRepositoryClassException extends RuntimeException
{
    public function __construct($repository)
    {
        parent::__construct('Invalid repository class for ' . $repository);
    }
} 