<?php
namespace Mindweb\Db;

abstract class Connection
{
    /**
     * @var mixed
     */
    private $handler;

    /**
     * @var bool
     */
    protected $isInitialized = false;

    /**
     * @return string
     */
    abstract public function getType();

    /**
     * @return mixed
     */
    public function getHandler()
    {
        if (!$this->isInitialized) {
            $this->handler = $this->initialize();
        }

        return $this->handler;
    }

    abstract protected function initialize();
}