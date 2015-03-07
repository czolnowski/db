<?php
namespace Mindweb\Db;

use Doctrine\DBAL;
use Mindweb\Config\Configuration;

class MysqlConnection extends Connection
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct(
            'mysql',
            DBAL\DriverManager::getConnection(
                $configuration->get('db'),
                new DBAL\Configuration()
            )
        );
    }
} 