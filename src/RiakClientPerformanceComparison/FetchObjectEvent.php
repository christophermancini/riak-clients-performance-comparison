<?php

namespace RiakClientPerformanceComparison;

use Athletic\AthleticEvent;
use RiakClientPerformanceComparison\RiakClients;

/**
 * @author Fabio B. Silva <fabio.bat.silva@gmail.com>
 */
class FetchObjectEvent extends AthleticEvent
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
    protected $key;

    public function classSetUp()
    {
        $key    = uniqid();
        $hash   = hash('crc32', __CLASS__ );
        $bucket = sprintf('riak-client-performance-comparison-%', $hash);

        $this->key     = $key;
        $this->bucket  = $bucket;
        $this->clients = new RiakClients();

        $this->storeObject();
    }

    protected function storeObject()
    {
        $object    = new \Riak\Client\Core\Query\RiakObject();
        $namespace = new \Riak\Client\Core\Query\RiakNamespace(null, $this->bucket);
        $location  = new \Riak\Client\Core\Query\RiakLocation($namespace, $this->key);
        $command   = new \Riak\Client\Command\Kv\StoreValue($location, $object);

        $object->setValue('[1,1,1]');
        $object->setContentType('application/json');

        $this->clients->getRiakClientProto()->execute($command);
    }

    /**
     * @iterations 1000
     */
    public function fetchUsingPhpRiakProto()
    {
        $connection = $this->clients->getPhpRiak();
        $bucket     = new \Riak\Bucket($connection, $this->bucket);

        $bucket->get($this->key);
    }

    /**
     * @iterations 1000
     */
    public function fetchUsingBashoRiakHttp()
    {
        $riak   = $this->clients->getBashoRiak();
        $bucket = $riak->bucket($this->bucket);

        $bucket->get($this->key);
    }

    /**
     * @iterations 1000
     */
    public function fetchUsingRiakClientHttp()
    {
        $namespace = new \Riak\Client\Core\Query\RiakNamespace(null, $this->bucket);
        $location  = new \Riak\Client\Core\Query\RiakLocation($namespace, $this->key);
        $command   = new \Riak\Client\Command\Kv\FetchValue($location, []);

        $this->clients->getRiakClientHttp()->execute($command);
    }

    /**
     * @iterations 1000
     */
    public function fetchUsingRiakClientProto()
    {
        $namespace = new \Riak\Client\Core\Query\RiakNamespace(null, $this->bucket);
        $location  = new \Riak\Client\Core\Query\RiakLocation($namespace, $this->key);
        $command   = new \Riak\Client\Command\Kv\FetchValue($location, []);

        $this->clients->getRiakClientProto()->execute($command);
    }
}
