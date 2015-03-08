<?php
namespace Mindweb\Db;

abstract class Connection
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $handler;

    /**
     * @param string $type
     * @param mixed $handler
     */
    public function __construct($type, $handler)
    {
        $this->type = $type;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }
}