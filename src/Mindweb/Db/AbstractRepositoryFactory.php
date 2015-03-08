<?php
namespace Mindweb\Db;

abstract class AbstractRepositoryFactory
{
    protected $repositories = array();

    /**
     * @return string
     */
    abstract protected function getVendor();

    /**
     * @return string
     */
    abstract protected function getNamespace();

    /**
     * @return array
     */
    abstract protected function getMapping();

    /**
     * @param Connection $connection
     * @param string $repository
     * @return Repository
     */
    public function get(Connection $connection, $repository)
    {
        $repositoryClassName = sprintf('%s\\%s\\Repository\\',
            $this->getVendor(), $this->getNamespace()
        );

        switch ($connection->getType()) {
            case 'mysql':
                $repositoryClassName .= 'Mysql';
                break;
        }

        $mapping = $this->getMapping();
        if (!isset($mapping[$repository])) {
            throw new Exception\NotMappedRepositoryException($repository);
        }
        $repositoryClassName .= $mapping[$repository];
        $repositoryClassName .= 'Repository';

        if (!isset($this->repositories[$repositoryClassName])) {
            $this->repositories[$repositoryClassName] = new $repositoryClassName($connection->getHandler());
        }

        if (!$this->repositories[$repositoryClassName] instanceof Repository) {
            throw new Exception\InvalidRepositoryClassException($repository);
        }

        return $this->repositories[$repositoryClassName];
    }
}