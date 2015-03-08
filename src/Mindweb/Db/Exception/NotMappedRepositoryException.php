<?php
namespace Mindweb\Db\Exception;

use RuntimeException;

class NotMappedRepositoryException extends RuntimeException
{
    public function __construct($repository)
    {
        parent::__construct('Not mapped repository: ' . $repository);
    }
} 