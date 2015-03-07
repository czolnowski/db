<?php
namespace Mindweb\Db;

use Mindweb\Config\Configuration;

class Factory
{
    /**
     * @var array
     */
    private static $connections = array();

    /**
     * @param Configuration $configuration
     * @param string $key
     * @return MysqlConnection
     */
    public static function create(Configuration $configuration, $key = 'db_type')
    {
        switch ($configuration->get($key)) {
            case 'mysql':
                if (!isset(self::$connections['mysql'])) {
                    self::$connections['mysql'] = new MysqlConnection($configuration);
                }

                return self::$connections['mysql'];
        }

        throw new Exception\InvalidDbTypeException($configuration->get($key));
    }
}