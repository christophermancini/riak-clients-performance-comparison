<?php

namespace RiakClientPerformanceComparison;

use Basho\Riak\Riak;
use Riak\Client\RiakClientBuilder;

/**
 * @author Fabio B. Silva <fabio.bat.silva@gmail.com>
 */
class RiakClients
{
    /**
     * @var \Riak\Client\RiakClient
     */
    protected $riakClientProto;

    /**
     * @var \Riak\Client\RiakClient
     */
    protected $riakClientHttp;

    /**
     * @var \Basho\Riak\Riak
     */
    protected $bashoRiak;

    /**
     * @return \Riak\Client\RiakClient
     */
    public function getRiakClientProto()
    {
        if ($this->riakClientProto == null) {
            $this->riakClientProto = $this->createRiakClientProto();
        }

        return $this->riakClientProto;
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function getRiakClientHttp()
    {
        if ($this->riakClientHttp == null) {
            $this->riakClientHttp = $this->createRiakClientHttp();
        }

        return $this->riakClientHttp;
    }

    /**
     * @return \Basho\Riak\Riak
     */
    public function getBashoRiak()
    {
        if ($this->bashoRiak == null) {
            $this->bashoRiak = $this->createBashoRiak();
        }

        return $this->bashoRiak;
    }

    /**
     * @param mixed $name
     * @param mixed $default
     *
     * @return string
     */
    public function getEnv($name, $default)
    {
        return getenv($name) ?: $default;
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClientProto()
    {
        return $this->createRiakClient($this->getEnv('RIAK_PROTO_URI', 'proto://127.0.0.1:8087'));
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClientHttp()
    {
        return $this->createRiakClient($this->getEnv('RIAK_HTTP_URI', 'http://127.0.0.1:8098'));
    }

    /**
     * @param string $nodeUri
     *
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClient($nodeUri)
    {
        $builder  = new RiakClientBuilder();
        $client   = $builder
            ->withNodeUri($nodeUri)
            ->build();

        return $client;
    }

    /**
     * @return \Basho\Riak\Riak
     */
    public function createBashoRiak()
    {
        $uri  = $this->getEnv('RIAK_HTTP_URI', 'http://127.0.0.1:8098');
        $host = parse_url($uri, PHP_URL_HOST);
        $port = parse_url($uri, PHP_URL_PORT);

        return new Riak($host, $port);
    }
}
