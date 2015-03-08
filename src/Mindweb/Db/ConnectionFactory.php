<?php
namespace Mindweb\Db;

use Mindweb\Config\Configuration;

class ConnectionFactory
{
    /**
     * @var array
     */
    private static $connections = array();

    /**
     * @param Configuration $configuration
     * @param string $key
     * @return Connection
     */
    public static function create(Configuration $configuration, $key = 'db_type')
    {
        $dbType = $configuration->get($key);

        if (!empty($dbType['connectionClassName'])) {
            $connectionClassName = $dbType['connectionClassName'];
        } elseif(!empty($dbType['vendor']) && !empty($dbType['namespace'])) {
            $connectionClassName = self::getConnectionClassNameFromDbType($dbType);
        } else {
            throw new Exception\InvalidDbTypeException();
        }

        if (isset(self::$connections[$connectionClassName])) {
            return self::$connections[$connectionClassName];
        }

        if (!class_exists($connectionClassName)) {
            throw new Exception\ConnectionClassDoesNotExistsException($connectionClassName);
        }

        $connection = new $connectionClassName($configuration);
        if (!$connection instanceof Connection) {
            throw new Exception\ConnectionClassDoesNotImplementConnectionException($connectionClassName);
        }

        self::$connections[$connectionClassName] = $configuration;

        return self::$connections[$connectionClassName];
    }

    /**
     * @param array $dbType
     * @return string
     */
    private static function getConnectionClassNameFromDbType($dbType)
    {
        $vendor = $dbType['vendor'];
        $namespace = $dbType['namespace'];
        $name = !empty($dbType['name']) ? $dbType['name'] : 'Connection';

        return sprintf('%s\\%s\\%s', $vendor, $namespace, $name);
    }
}