<?php

namespace RiakClientPerformanceComparison;

use Athletic\AthleticEvent;
use RiakClientPerformanceComparison\RiakClients;

/**
 * @author Fabio B. Silva <fabio.bat.silva@gmail.com>
 */
class StoreObjectEvent extends AthleticEvent
{
    /**
     * @var \RiakClientPerformanceComparison\RiakClients
     */
    protected $clients;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $data;

    public function classSetUp()
    {
        $hash   = hash('crc32', __CLASS__ );
        $bucket = sprintf('riak-client-performance-comparison-%', $hash);

        $this->bucket  = $bucket;
        $this->data    = '[1,2,3]';
        $this->clients = new RiakClients();
    }

    /**
     * @iterations 1000
     */
    public function storeUsingBashoRiakHttp()
    {
        $riak = $this->clients->getBashoRiakHttp();

        $command = (new \Basho\Riak\Command\Builder\StoreObject($riak))
            ->buildJsonObject($this->data)
            ->buildBucket($this->bucket)
            ->build();

        $command->execute();
    }

    /**
     * @iterations 1000
     */
    public function storeUsingRiakClientHttp()
    {
        $object    = new \Riak\Client\Core\Query\RiakObject();
        $namespace = new \Riak\Client\Core\Query\RiakNamespace(null, $this->bucket);
        $location  = new \Riak\Client\Core\Query\RiakLocation($namespace, null);
        $command   = new \Riak\Client\Command\Kv\StoreValue($location, $object);

        $object->setValue($this->data);
        $object->setContentType('application/json');

        $this->clients->getRiakClientHttp()->execute($command);
    }

    /**
     * @iterations 1000
     */
    public function storeUsingBashoRiakProto()
    {
        $riak = $this->clients->getBashoRiakProto();

        $command = (new \Basho\Riak\Command\Builder\StoreObject($riak))
            ->buildJsonObject($this->data)
            ->buildBucket($this->bucket)
            ->build();

        $command->execute();
    }

    /**
     * @iterations 1000
     */
    public function storeUsingRiakClientProto()
    {
        $object    = new \Riak\Client\Core\Query\RiakObject();
        $namespace = new \Riak\Client\Core\Query\RiakNamespace(null, $this->bucket);
        $location  = new \Riak\Client\Core\Query\RiakLocation($namespace, null);
        $command   = new \Riak\Client\Command\Kv\StoreValue($location, $object);

        $object->setValue($this->data);
        $object->setContentType('application/json');

        $this->clients->getRiakClientProto()->execute($command);
    }
}
